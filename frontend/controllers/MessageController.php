<?php

namespace frontend\controllers;

use Yii;
use app\models\Message;
use frontend\models\MessageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\db\IntegrityException;
use frontend\models\AllowedContacts;

/**
 * MessageController implements the CRUD actions for Message model.
 */
class MessageController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Message models.
     * @return mixed
     */
    public function actionInbox()
    {
        $searchModel = new MessageSearch();
        $searchModel->to = Yii::$app->user->id;

        $searchModel->inbox = true;

        Yii::$app->user->setReturnUrl(['inbox']);

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $users = ArrayHelper::map(
            Message::find()->where(['to' => Yii::$app->user->id])->groupBy('from')->all(), 'from', 'sender.username');

        return $this->render('inbox', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'users' => $users,
        ]);
    }



    /**
     * Creates a new Message model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Message();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Message model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Message model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Message the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($hash)
    {
        $message = Message::find()->where(['hash' => $hash])->one();

        if (!$message)
            throw new NotFoundHttpException(Yii::t('message', 'The requested message does not exist.'));

        if (Yii::$app->user->id != $message->to && Yii::$app->user->id != $message->from)
            throw new ForbiddenHttpException(Yii::t('message', 'You are not allowed to access this message.'));

        return $message;
    }

    public function actionSent()
    {
        $searchModel = new MessageSearch();
        $searchModel->from = Yii::$app->user->id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        Yii::$app->user->setReturnUrl(['sent']);

        return $this->render('sent', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionMarkAllAsRead()
    {
        foreach (Message::find()->where([
            'to' => Yii::$app->user->id,
            'status' => Message::STATUS_UNREAD])->all() as $message)
            $message->updateAttributes(['status' => Message::STATUS_READ]);

        return $this->redirect(Yii::$app->request->referrer);
    }


    public function actionView($hash)
    {
        $message = $this->findModel($hash);

        if ($message->status == Message::STATUS_UNREAD && $message->to == Yii::$app->user->id)
            $message->updateAttributes(['status' => Message::STATUS_READ]);

        return $this->render('view', [
            'message' => $message
        ]);
    }
    public function add_to_recipient_list($to)
    {
        if ($recipient = User::findOne($to)) {
            try {
                $ac = new AllowedContacts();
                $ac->user_id = Yii::$app->user->id;
                $ac->is_allowed_to_write = $to;
                $ac->save();

                $ac = new AllowedContacts();
                $ac->user_id = $to;
                $ac->is_allowed_to_write = Yii::$app->user->id;
                $ac->save();
            } catch (IntegrityException $e) {
                // ignore integrity constraint violation in case users are already connected
            }
        } else throw new NotFoundHttpException();
    }


    public function actionCompose($to = null, $answers = null, $context = null, $add_to_recipient_list = false)
    {

        if (Yii::$app->request->isAjax) {
            $this->layout = false;
        }


        if ($add_to_recipient_list && $to) {
            $this->add_to_recipient_list($to);
        }

        $model = new Message();
        $possible_recipients = Message::getPossibleRecipients(Yii::$app->user->id);

        if (!Yii::$app->user->returnUrl) {
            Yii::$app->user->setReturnUrl(Yii::$app->request->referrer);
        }

        if ($answers) {
            $origin = Message::find()->where(['hash' => $answers])->one();

            if (!$origin) {
                throw new NotFoundHttpException(Yii::t('message', 'Message to be answered can not be found'));
            }
        }

        if (Yii::$app->request->isPost) {
            $recipients = Yii::$app->request->post()['Message']['to'];

            if (is_numeric($recipients)) # Only one recipient given
                $recipients = [$recipients];

            foreach ($recipients as $recipient_id) {
                $model = new Message();
                $model->load(Yii::$app->request->post());
                $model->to = $recipient_id;
                $model->save();

                if ($answers) {
                    if ($origin && $origin->to == Yii::$app->user->id && $origin->status == Message::STATUS_READ) {
                        $origin->updateAttributes(['status' => Message::STATUS_ANSWERED]);
                    }
                }
            }
            return Yii::$app->request->isAjax ? true : $this->goBack();
        } else {
            if ($to) {
                $model->to = [$to];
            }

            if ($context) {
                $model->context = $context;
            }

            if ($answers) {
                $prefix = Yii::$app->getModule('message')->answerPrefix;

                // avoid stacking of prefixes (Re: Re: Re:)
                if (substr($origin->title, 0, strlen($prefix)) !== $prefix) {
                    $model->title = $prefix . $origin->title;
                } else {
                    $model->title = $origin->title;
                }

                $model->context = $origin->context;
            }

            return $this->render('compose', [
                'model' => $model,
                'answers' => $answers,
                'context' => $context,
                'dialog' => Yii::$app->request->isAjax,
                'allow_multiple' => true,
                'possible_recipients' => ArrayHelper::map($possible_recipients, 'id', 'username'),
            ]);
        }
    }

}

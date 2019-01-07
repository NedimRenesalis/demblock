<?php

namespace backend\controllers;

use common\models\Advert;
use common\models\Apply;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\User;
use backend\models\UserSearch;
use backend\models\UserMoney;
use yii\web\NotFoundHttpException;


/**
 * Site controller
 */
class SupplierBuyerController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['index', 'view', 'block', 'un-block', 'money'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {

        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, 4);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
        $user = new UserMoney();

        if ($user->load(Yii::$app->request->post())) {
            $model->money += $user->money;
            $model->save();
            if ($user->money > 0) {
                \Yii::$app->getSession()->setFlash('success', 'Tokens have been added.');
            } else {
                \Yii::$app->getSession()->setFlash('error', 'Credits have been removed.');
            }
            Yii::$app
                ->mailer
                ->compose(
                    ['html' => 'uplata-html', 'text' => 'uplata-text'],
                    ['user' => $model]
                )
                ->setFrom("support@demblock.com")
                ->setTo($model->email)
                ->setSubject("Tokens have been added to your account")
                ->send();
        }

        $user->money = null;

        return $this->render('view', [
            'user' => $user,
            'model' => $model,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionBlock($id)
    {
        if (($model = User::findOne($id)) !== null) {
            $model->isBlocked = 1;
            $model->save();
            \Yii::$app->getSession()->setFlash('error', 'The user has been blocked and listings removed.');
            $adverts = Advert::find()->where(['user_id' => $model->id])->all();

            foreach ($adverts as $advert) {
                Apply::deleteAll(['advert_id' => $advert->id]);
                $advert->delete();
            }
            $this->redirect(['view', 'id' => $id]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionUnBlock($id)
    {
        if (($model = User::findOne($id)) !== null) {
            $model->isBlocked = 0;
            $model->save();
            \Yii::$app->getSession()->setFlash('info', 'This account has been reactivated.');
            $this->redirect(['view', 'id' => $id]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}

<?php

namespace backend\controllers;

use common\models\User;
use Yii;
use common\models\Advert;
use backend\models\AdvertSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use kartik\mpdf\Pdf;

/**
 * AdvertController implements the CRUD actions for Advert model.
 */
class AdvertController extends Controller
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
                        'actions' => ['index', 'view', 'publish', 'un-publish', 'pdf', 'html', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Advert models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AdvertSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Advert model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Advert model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Advert();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Advert model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Advert model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Advert model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Advert the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Advert::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function actionPublish($id)
    {
        if (($model = Advert::findOne($id)) !== null) {
            $model->isPublished = 1;
            $model->save();
            \Yii::$app->getSession()->setFlash('info', 'User has been published.');
            $this->redirect(['view', 'id' => $id]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionUnPublish($id)
    {
        if (($model = Advert::findOne($id)) !== null) {
            $model->isPublished = 0;
            $model->save();
            \Yii::$app->getSession()->setFlash('error', 'User has been unpublished.');
            $this->redirect(['view', 'id' => $id]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionHtml($id){

        if (!$id) {
            $this->redirect("index");
        }

        $advert = Advert::find()->where(['id' => $id])->one();
        $user = User::find()->where(['id' => $advert->user_id])->one();

        if (!$advert || !$user) {
            \Yii::$app->getSession()->setFlash('error', 'Desio se problem prilikom prikazivanja oglasa.');
            return $this->render('report-error');
        } else {
            return $this->renderPartial('html', [
                'user' => $user,
                'advert' => $advert
            ]);
        }
    }


    public function actionPdf($id)
    {

        $advert = Advert::find()->where(['id' => $id])->one();
        $user = User::find()->where(['id' => $advert->user_id])->one();

        if (!$advert || !$user) {
            \Yii::$app->getSession()->setFlash('error', 'Desio se problem prilikom prikazivanja oglasa.');
            return $this->render('report-error');
        }
        // get your HTML raw content without any layouts or scripts
        $content = $this->renderPartial('pdf', [
            'user' => $user,
            'advert' => $advert
        ]);

        define('_MPDF_TTFONTDATAPATH',Yii::getAlias('@runtime/mpdf'));

        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content,

        ]);

        // return the pdf output as per the destination setting
        return $pdf->render();
    }
}

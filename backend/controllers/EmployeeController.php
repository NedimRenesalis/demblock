<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\User;
use backend\models\UserSearch;
use yii\web\NotFoundHttpException;


/**
 * Site controller
 */
class EmployeeController extends Controller
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
                        'actions' => ['index', 'view', 'block', 'un-block', 'download-cv'],
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
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, 3, 4);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
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
            $this->redirect(['view', 'id' => $id]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public
    function actionDownloadCv()
    {

        $id = Yii::$app->request->get('id');

        $user = User::find()->where(['username' => Yii::$app->user->identity->username])->one();

        if ($user == null) {
            return $this->goHome();
        }

        $type = $user->getUserType();


        if ($type == 1) {

            $employee = User::find()->where(["id" => $id])->one();



            if (!$employee || !$employee->image) {
                return $this->redirect("index");
            }

            $path = Yii::getAlias('@webroot') . '/';
            $file = $path . $employee->image;
            $file = str_replace("backend", "frontend", $file);

            if (file_exists($file)) {
                Yii::$app->response->sendFile($file);
                return;
            }

        }

    }
}

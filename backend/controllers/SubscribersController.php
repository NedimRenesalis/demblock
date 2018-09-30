<?php

namespace backend\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\web\Controller;

use backend\models\Subscribe;
use backend\models\SubscribeSearch;

/**
 * Controls the actions for subscribers section
 *
 * @Class SubscribersController
 * @package backend\controllers
 */
class SubscribersController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SubscribeSearch();
        $dataProvider = $searchModel->search(request()->queryParams);
        $dataProvider->pagination->pageSize = 10;

        return $this->render('list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all subscribers
     *
     * @param $id
     * @return string
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Deletes a specific subscriber
     *
     * @param $id
     * @return \yii\web\Response
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();
        notify()->addSuccess(t('app', 'Your action is complete.'));

        return $this->redirect(['/admin/subscribers']);
    }

    /**
     * @param $id
     * @return static
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = Subscribe::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

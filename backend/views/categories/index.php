<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\models\Categories;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CategoriesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categories-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Add category'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=

    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

         //   'Id',
            'Name',

            [
               'label' => 'Main Category',
                'attribute' => 'ParentId',
                'value' => function ($searchModel) {
                    $category = Categories::find()->where((["Id" =>$searchModel->ParentId]))->one();
                    if($category) {
                        return $category->Name;
                    } else {
                        return '';
                    }
                }

            ],
          //  'ParentId',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

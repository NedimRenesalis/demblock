<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Categories;
/* @var $this yii\web\View */
/* @var $model backend\models\Categories */

$this->title = $model->Name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categories-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->Id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->Id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'Id',
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
            'Name',
        ],
    ]) ?>

</div>

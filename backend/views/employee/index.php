<?php

use yii\helpers\Html;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Zapošljavanje';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode("Posloprimci") ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label' => 'Email',
                'attribute' => 'email',
            ],

            [
                'label' => 'Ime',
                'attribute' => 'first_name',
            ],
            [
                'label' => 'Prezime',
                'attribute' => 'last_name',
            ],

            [
                'label' => 'Country',
                'attribute' => 'location',
            ],

            ['class' => 'yii\grid\ActionColumn', 'template'=>'{view}'],
        ],
    ]); ?>
</div>

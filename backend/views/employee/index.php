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
                'label' => 'Jezik',
                'attribute' => 'language',
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
                'label' => 'Godina rodjena',
                'attribute' => 'year_of_birth',
            ],
            [
                'label' => 'Posao',
                'attribute' => 'job',
            ],
            [
                'label' => 'Lokacija',
                'attribute' => 'location',
            ],
            [
                'label' => 'Postanski broj',
                'attribute' => 'zip_code',
            ],
            [
                'label' => 'Spol',
                'attribute' => 'gender',
            ],

            [
                'label' => 'Struka',
                'attribute' => 'career_level',
            ],
            [
                'label' => 'Obrazovanje',
                'attribute' => 'education_level',
            ],
            ['class' => 'yii\grid\ActionColumn', 'template'=>'{view}'],
        ],
    ]); ?>
</div>

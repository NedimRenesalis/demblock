<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = $this->title;
$this->title = 'demblock';
?>
<div class="user-index">

    <h1><?= Html::encode("Poslodavci") ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label' => 'Korisnicko ime',
                'attribute' => 'username',
            ],
            [
                'label' => 'Ime',
                'attribute' => 'full_name',
            ],

            [
                'label' => 'Ime kompanije',
                'attribute' => 'company_name',
            ],

            [
                'label' => 'Adresa',
                'attribute' => 'address',
            ],

            [
                'label' => 'Novac',
                'attribute' => 'money',
            ],
            [
                'label' => 'Ukupno novca',
                'attribute' => 'total_money',
            ],
            [
                'label' => 'Telefon',
                'attribute' => 'phone',
            ],

            ['class' => 'yii\grid\ActionColumn', 'template' => '{view}'],
        ],
    ]); ?>
</div>

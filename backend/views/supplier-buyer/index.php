<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = $this->title;
$this->title = 'Zapošljavanje';
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
                'label' => 'Jezik',
                'attribute' => 'language',
            ],
            [
                'label' => 'Ime kompanije',
                'attribute' => 'company_name',
            ],
            [
                'label' => 'PDV',
                'attribute' => 'pdv',
            ],
            [
                'label' => 'Adresa',
                'attribute' => 'address',
            ],
            [
                'label' => 'Postanski broj',
                'attribute' => 'zip_code',
            ],
            [
                'label' => 'PDV',
                'attribute' => 'pdv',
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

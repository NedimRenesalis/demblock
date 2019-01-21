<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AdvertTypesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'demblock';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="advert-types-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Advert Types', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label' => 'Ime',
                'attribute' => 'title',
            ],
            [
                'label' => 'Tip',
                'attribute' => 'type',
            ],
            [
                'label' => 'Jezik',
                'attribute' => 'language',
            ],
            [
                'label' => 'Broj dana',
                'attribute' => 'days',
            ],
            [
                'label' => 'Cijena',
                'attribute' => 'price',
            ],
            [
                'label' => 'Broj pozicija',
                'attribute' => 'positions',
                'value' => function ($model) {
                    switch ($model->positions) {
                        case 1:
                            return "1";
                            break;
                        case 5:
                            return "2-5";
                            break;
                        case 10:
                            return "6-10";
                            break;
                        case 1000:
                            return "preko 10";
                            break;
                        default:
                            return "not defined";
                            break;
                    }
                },
                'filter' => array(
                    1 => "1",
                    5 => "2-5",
                    10 => "6-10",
                    1000 => "over 10",
                ),

            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

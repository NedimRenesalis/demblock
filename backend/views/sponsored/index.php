<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SponsoredSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sponsoreds';
$this->params['breadcrumbs'][] = $this->title;
$this->title = 'Zapošljavanje';
?>
<div class="sponsored-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Kreiraj premium oglas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'Naslov',
                'attribute' => 'title',
            ],
            [
                'label' => 'HTML',
                'attribute' => 'html',
            ],
            [
                'label' => 'Objavljeno',
                'attribute' => 'isPublished',
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AdvertTypes */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Cijene oglasa', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="advert-types-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Izmjeni', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Obrisi', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
                'label' => 'Positions',
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
                }
            ],
        ],
    ]) ?>

</div>

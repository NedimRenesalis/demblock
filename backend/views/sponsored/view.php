<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Sponsored */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sponzorisani oglasi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->title = 'demblock';
?>
<div class="sponsored-view">

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
        ],
    ]) ?>

    <?= $model->html ;?>

</div>

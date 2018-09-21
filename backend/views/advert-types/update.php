<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AdvertTypes */

$this->title = 'Update Advert Types: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Advert Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="advert-types-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

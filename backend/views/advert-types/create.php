<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\AdvertTypes */

$this->title = 'Create Advert Types';
$this->params['breadcrumbs'][] = ['label' => 'Advert Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="advert-types-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

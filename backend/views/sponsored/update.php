<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Sponsored */

$this->title = 'Update Sponsored: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sponsoreds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
$this->title = 'demblock';
?>
<div class="sponsored-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

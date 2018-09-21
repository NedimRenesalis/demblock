<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Sponsored */

$this->title = 'Create Sponsored';
$this->params['breadcrumbs'][] = ['label' => 'Sponsoreds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->title = 'Zapošljavanje';
?>
<div class="sponsored-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

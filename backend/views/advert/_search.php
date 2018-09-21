<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AdvertSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="advert-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'position') ?>

    <?= $form->field($model, 'start_advert') ?>

    <?= $form->field($model, 'number_of_days') ?>

    <?= $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'isPublished') ?>

    <?php // echo $form->field($model, 'number_of_positions') ?>

    <?php // echo $form->field($model, 'web_address') ?>

    <?php // echo $form->field($model, 'contact_email') ?>

    <?php // echo $form->field($model, 'contact_person') ?>

    <?php // echo $form->field($model, 'location') ?>

    <?php // echo $form->field($model, 'category') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'anonymously') ?>

    <?php // echo $form->field($model, 'payment') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

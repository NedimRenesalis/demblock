<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AdvertTypes */
/* @var $form yii\widgets\ActiveForm */

$languages = [
        "BA" => "BA",
        "DE" => "DE",
        "EN" => "EN"
];
$types = [
        "platinum" => "Platinum",
        "premium" => "Premium",
        "normal" => "Normal",
];
?>

<div class="advert-types-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList($types) ?>

    <?= $form->field($model, 'language')->dropDownList($languages) ?>

    <?= $form->field($model, 'days')->textInput() ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'positions')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

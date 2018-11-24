<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use frontend\assets\UploadAsset;

UploadAsset::register($this);
/* @var $this yii\web\View */
/* @var $model app\models\CompanyInformation */
/* @var $form ActiveForm */
?>
<div class="site-user-profile-company-information">

    <?php $form = ActiveForm::begin(); ?>
    <?php $date = DateTime::createFromFormat("Y-m-d", $model->Year);
    $model->Year =  $date->format("Y"); ?>
        <?= $form->field($model, 'Year')->textInput(['type' => 'number', 'min' => 1800]) ?>
        <?= $form->field($model, 'NumberOfEmployees')->textInput(['type' => 'number', 'min' => 0]) ?>
        <?= $form->field($model, 'AboutUs') ?>
        <?= $form->field($model, 'CompanyName') ?>
        <?= $form->field($model, 'Website') ?>
        <?= $form->field($model, 'RegisteredAddress') ?>
        <?= $form->field($model, 'OperationalAddress') ?>
    
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-user-profile-company-information -->

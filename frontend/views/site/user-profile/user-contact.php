<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\assets\UploadAsset;

UploadAsset::register($this);

/* @var $this yii\web\View */
/* @var $model app\models\UserContactInformation */
/* @var $form ActiveForm */
?>

<div class="info-edit">
    <h3 class="info-header">EDIT USER CONTACT DETAILS</h3>

    <div class="info-content-edit">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'AlternativeEmail')->input('email') ?>
        <?= $form->field($model, 'Phone') ?>
        <?= $form->field($model, 'Fax') ?>
        <?= $form->field($model, 'Mobile') ?>
        <?= $form->field($model, 'Facebook') ?>
        <?= $form->field($model, 'Twitter') ?>
        <?= $form->field($model, 'Instagram') ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>

</div>

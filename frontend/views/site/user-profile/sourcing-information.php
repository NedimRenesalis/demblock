<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SourcingInformation */
/* @var $form ActiveForm */
?>
<div class="info-edit">
    <h3>EDIT SOURCING INFORMATION</h3>
    
    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'AnnualPurchasingVolume') ?>
        <?= $form->field($model, 'PrimarySourcingPurpose') ?>
        <?= $form->field($model, 'AverageSourcingFrequency') ?>
        <?= $form->field($model, 'PreferredSupplierQualifications') ?>
        <?= $form->field($model, 'PreferredIndustries') ?>
    
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-user-profile-sourcing-information -->

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SourcingInformation */
/* @var $form ActiveForm */
?>
<div class="site-user-profile-sourcing-information">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-4">
        <?= $form->field($model, 'AnnualPurchasingVolume') ?>
        <?= $form->field($model, 'PrimarySourcingPurpose') ?>
        <?= $form->field($model, 'AverageSourcingFrequency') ?>
        <?= $form->field($model, 'PreferredSupplierQualifications') ?>
        <?= $form->field($model, 'PreferredIndustries') ?>
    
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-user-profile-sourcing-information -->

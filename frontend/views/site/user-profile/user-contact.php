<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserContactInformation */
/* @var $form ActiveForm */
?>
<div class="site-user-profile-user-contact">
    <div class="row">
        <div class="col-md-4">
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

</div><!-- site-user-profile-user-contact -->

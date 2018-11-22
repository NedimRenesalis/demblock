<?php

/* @var $this yii\web\View */
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Zapošljavanje';
?>

<div class="sign-container">
    <div class="login" style="height: 300px; position: absolute; top: 25%;">
        <div class="sign-header">
            <h2>Please choose new password</h2>
        </div>
        <p class="text-center"></p>
        <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>
        <?= $form->field($model, 'password')->passwordInput(['autofocus' => true])->label('') ?>
        <div class="form-group">
            <?= Html::submitButton('Sačuvaj', ['class' => 'active btn btn-block btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

<?php

/* @var $this yii\web\View */
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Zapošljavanje';
?>

<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img src="<?= Url::to('@web/css/images/login-left.jpg'); ?>" class="img-responsive">
            </div>
            <div class="col-md-4">
                <p class="text-center">Molimo izaberite novu lozinku:</p>
                <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>
                <?= $form->field($model, 'password')->passwordInput(['autofocus' => true])->label('') ?>
                <div class="form-group">
                    <?= Html::submitButton('Sačuvaj', ['class' => 'active btn btn-block btn-primary']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
            <div class="col-md-4">
                <img src="<?= Url::to('@web/css/images/login-right.jpg'); ?>" class="img-responsive">
            </div>
        </div>
    </div>
</div>

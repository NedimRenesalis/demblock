<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
$this->title = 'Zapošljavanje';
?>

<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img src="<?= Url::to('@web/css/images/password-forgotten.jpg'); ?>" class="img-responsive">
            </div>
            <div class="col-md-4">

                <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form', 'fieldConfig' => ['template' => '{label}{input}']]); ?>

                <?= $form->field($model, 'email')->textInput(['autofocus' => true])->label("Za promjenu lozinke - unesite Vaš e-mail") ?>

                <div class="form-group">
                    <?= Html::submitButton('Pošalji zahtijev', ['class' => 'active btn btn-block btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
            <div class="col-md-4">
                <img src="<?= Url::to('@web/css/images/password-forgotten.jpg'); ?>" class="img-responsive">
            </div>
        </div>
    </div>
</div>
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p class="text-center">U slučaju eventualnih problema – kontaktirajte nas na oglasi@zaposljavanje.ba</p>
            </div>
        </div>
    </div>
</div>
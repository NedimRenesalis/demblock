<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
$this->title = 'Zapošljavanje';
?>

<div class="sign-container">
<div class="login" style="
    margin: nuset;
    display: flex;
    align-items: center;
    margin: 50px auto;"
>
    <div class="sign-header">
        <h2>RESET PASSWORD</h2>
    </div>
    <div style="width: 340px; margin: auto;" class="reset-password">
        <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form', 'fieldConfig' => ['template' => '{label}{input}']]); ?>

        <?= $form->field($model, 'email')->textInput(['autofocus' => true])->label("Za promjenu lozinke - unesite Vaš e-mail") ?>

        <div class="form-group">
            <?= Html::submitButton('Pošalji zahtijev', ['class' => 'active btn btn-block btn-primary']) ?>
        </div>
 
            <div style="">
                <p class="text-center">U slučaju eventualnih problema – kontaktirajte nas na</p>
                <a>oglasi@zaposljavanje.ba</a>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
    

</div>
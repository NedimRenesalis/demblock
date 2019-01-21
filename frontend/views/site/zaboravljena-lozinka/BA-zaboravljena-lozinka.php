<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
$this->title = 'demblock';
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

        <?= $form->field($model, 'email')->textInput(['autofocus' => true])->label("Your email") ?>

        <div class="form-group">
            <?= Html::submitButton('Send password reset request', ['class' => 'active btn btn-block btn-primary']) ?>
        </div>
 
            
        <?php ActiveForm::end(); ?>
    </div>
</div>
    

</div>
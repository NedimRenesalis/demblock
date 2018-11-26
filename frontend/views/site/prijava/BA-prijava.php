<?php
use yii\helpers\Url;
use yii\widgets\ActiveForm;
$this->title = 'Zapošljavanje';
?>

<div class="sign-container">
    <div class="login">
        <div class="sign-header">
            <h2>LOGIN</h2>
        </div>
        <?php $form = ActiveForm::begin(['id' => 'prijava-form']); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label("Your email address") ?>
        <?= $form->field($model, 'password')->passwordInput()->label("Your password") ?>

        <?= $form->field($model, 'rememberMe')->checkbox(['label' => null])->label("Stay logged in") ?>

        <div class="form-group">
            <button class="active btn btn-block btn-info" type="submit">Login</button>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
    <div class="login-footer">
            <a class="btn btn-info active" href="<?= Url::to('zaboravljena-lozinka'); ?>">Lost your password? Create a new one.</a>
    </div>
</div>

<div style="display: none;">
            <div class="col-md-4">
                <img src="<?= Url::to('@web/css/images/login-left.jpg'); ?>" class="img-responsive">
            </div>

            <div class="col-md-4">
                <img src="<?= Url::to('@web/css/images/login-right.jpg'); ?>" class="img-responsive">
            </div>
</div>
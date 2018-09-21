<?php
use yii\helpers\Url;
use yii\widgets\ActiveForm;
$this->title = 'Zapošljavanje';
?>
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img src="<?= Url::to('@web/css/images/login-left.jpg'); ?>" class="img-responsive">
            </div>
            <div class="col-md-4">

                <h3 class="form-signin-heading text-center">Sign in</h3>

                <?php $form = ActiveForm::begin(['id' => 'prijava-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label("Email address") ?>

                <?= $form->field($model, 'password')->passwordInput()->label("Password") ?>

                <?= $form->field($model, 'rememberMe')->checkbox(['label' => null])->label("Remember me") ?>

                <div class="form-group">
                    <button class="active btn btn-block btn-info" type="submit">Sign In</button>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
            <div class="col-md-4">
                <img src="<?= Url::to('@web/css/images/login-right.jpg'); ?>" class="img-responsive">
            </div>
        </div>
    </div>
</div>
<div class="hidden-lg hidden-md hidden-sm section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <a class="active btn btn-block btn-success" href="<?= Url::to('zaboravljena-lozinka'); ?>">If you forgot your password</a>

                <a class="active btn btn-block btn-success" href="<?= Url::to('registracija-posloprimac'); ?>">Sign up employee</a>

                <a class="active btn btn-block btn-success" href="<?= Url::to('registracija-poslodavac'); ?>">Sign up employer</a>
            </div>
        </div>
    </div>
</div>
<div class="hidden-xs section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <a class="active btn btn-success" href="<?= Url::to('zaboravljena-lozinka'); ?>">If you forgot your password</a>
                <a class="active btn btn-success" href="<?= Url::to('registracija-posloprimac'); ?>">Sign up employee</a>
                <a class="active btn btn-success" href="<?= Url::to('registracija-poslodavac'); ?>">Sign up employer</a>
            </div>
        </div>
    </div>
</div>
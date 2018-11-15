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

        <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label("Email adresa") ?>
        <?= $form->field($model, 'password')->passwordInput()->label("Lozinka") ?>

        <?= $form->field($model, 'rememberMe')->checkbox(['label' => null])->label("Zapamti me") ?>

        <div class="form-group">
            <button class="active btn btn-block btn-info" type="submit">Prijava</button>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
    <div class="login-footer">
            <a class="btn btn-info active" href="<?= Url::to('zaboravljena-lozinka'); ?>">Ako ste zaboravili lozinku - kliknite ovde</a>

            <a class="btn btn-info active" href="<?= Url::to('registracija-posloprimac'); ?>">Ako niste registrovani kao posloprimac</a>

            <a class="btn btn-info active" href="<?= Url::to('registracija-poslodavac'); ?>">Ako niste registrovani kao poslodavac</a>
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
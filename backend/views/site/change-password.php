<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Zapošljavanje';
?>
<div class="site-index">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'oldPassword')->passwordInput()->label("Trenutna lozinka") ?>

    <?= $form->field($model, 'password')->passwordInput()->label("Nova lozinka") ?>

    <?= $form->field($model, 'confirmPassword')->passwordInput()->label("Ponovite novu lozinku") ?>

    <div class="form-group">
        <?= Html::submitButton( 'Promijeni lozinku', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
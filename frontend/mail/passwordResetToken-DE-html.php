<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManagerFrontend->createAbsoluteUrl(['site/promijeni-lozinku', 'token' => $user->password_reset_token]);
?>
<div class="password-reset">
    <p>Hallo <?= Html::encode($user->username) ?>,</p>

    <p>Klicken Sie bitte auf diesen Link um ein neues Passwort zu ertstellen:</p>

    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
</div>

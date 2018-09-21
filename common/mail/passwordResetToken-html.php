<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/promijeni-lozinku', 'token' => $user->password_reset_token]);
?>
<div class="password-reset">
    <p>Pozdrav / Hallo / Hello <?= Html::encode($user->username) ?>,</p>

    <p>Za promjenu lozinke klikni na link ispod:</p>
    <p>Unten klicken um ein neues Password zu generieren:</p>
    <p>Click on the link below to generate a new password:</p>

    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
</div>

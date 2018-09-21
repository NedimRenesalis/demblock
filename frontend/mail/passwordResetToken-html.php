<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/promijeni-lozinku', 'token' => $user->password_reset_token]);
?>
<div class="password-reset">
    <p>Pozdrav <?= Html::encode($user->username) ?>,</p>

    <p>Za promjenu lozinke klikni na link ispod:</p>

    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
</div>

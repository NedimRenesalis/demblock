<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManagerFrontend->createAbsoluteUrl(['site/promijeni-lozinku', 'token' => $user->password_reset_token]);
?>
<div class="password-reset">

    <p>Click on the link below to generate a new password:</p>

    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
</div>

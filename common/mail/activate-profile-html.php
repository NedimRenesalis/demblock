<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$activateLink = Yii::$app->urlManagerFrontend->createAbsoluteUrl(['site/activate-profile', 'key' => $user->auth_key]);
?>
<div class="password-reset">
    <p>Hello <?= Html::encode($user->username) ?>,</p>

    <p>Click the link below to verify your profile:</p>

    <p><?= Html::a(Html::encode($activateLink), $activateLink) ?></p>
</div>

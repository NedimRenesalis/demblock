<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/promijeni-lozinku', 'token' => $user->password_reset_token]);
?>
Pozdrav, Hallo,  Hello <?= $user->username ?>,

Um ein neues Password zu generieren, unten klicken. Click on the link below to generate a new password. Za promjenu lozinke klikni na link ispod::

<?= $resetLink ?>

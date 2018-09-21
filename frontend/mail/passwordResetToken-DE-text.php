<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/promijeni-lozinku', 'token' => $user->password_reset_token]);
?>
Hallo <?= $user->username ?>,

Klicken Sie bitte auf diesen Link um ein neues Passwort zu ertstellen::

<?= $resetLink ?>

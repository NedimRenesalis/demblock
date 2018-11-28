<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

?>



<?php if($user->language == "DE"): ?>
    Ihr Guthaben beträgt: <?= $user->money; ?>  €.
    <br>Sie können jetzt Ihre Stellenanzeige veröffentlichen.
<?php elseif($user->language == "EN"): ?>
    Your credit is <?= $user->money; ?>  €.
    <br>Now you can publish your job posting.
<?php else: ?>
    <br>Dear customer,
    <br>
    <br>You have successfully added tokens to your account.
    <br>
    <br>Your account's new token balance is <?= $user->money; ?> .
    <br>
    <br>Now you can list your product.
    <br>
    <br>Your product listing will be online immediately.
    <br>

    <br>In case you have any questions, please contact our support.
    <br>
    <br>Best regards
    <br>
    <br>


<?php endif; ?>

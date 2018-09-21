<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

?>
Pozdrav, Hallo,  Hello <?= $user->username ?>,


<?php if($user->language == "DE"): ?>
    Wir haben Ihre Zahlung erhalten. Ihr Guthaben betraegt: <?= $user->total_money; ?>  €.
    <br>Jetzt können Sie Ihre Stellenanzeigen veröffentlichen.
<?php elseif($user->language == "EN"): ?>
    We received your payment. Your credit is <?= $user->total_money; ?>  €.
    <br>Now you can publish your job posting.
<?php else: ?>
    Izvršena je dopuna na Vaš profil. Novo stanje računa: <?= $user->total_money; ?> KM.
    <br>Sada možete objaviti oglas.
<?php endif; ?>

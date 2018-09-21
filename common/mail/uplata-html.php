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
    <br>Poštovani,
    <br>
    <br>Novo stanje na Vašem računu je <?= $user->money; ?> KM
    <br>
    <br>Sada možete odmah nakon prijave na https://www.zaposljavanje.ba/prijava sastaviti i objaviti oglas u polju “objava oglasa”.
    <br>
    <br>Oglas je odmah nakon unosa i objave online.
    <br>

    <br>U slucaju eventualnih pitanja, kontaktirajte nas na oglasi@zaposljavanje.ba ili putem telefona na 062-332-325.
    <br>
    <br>S poštovanjem,
    <br>
    <br>Vaš zaposljavanje.ba tim


<?php endif; ?>

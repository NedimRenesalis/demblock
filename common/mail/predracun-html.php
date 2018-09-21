<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */
/* @var $user common\models\Advert */
use yii\helpers\Url;

?>

<?php
$payment = "Po predračunu / uplatnicom - Banküberweisung - Payment / deposit slip";
 if ($advert->payment == 3) {
    $payment = "Kreditna kartica - Kreditkarte - Creditcard";

}

$moneyType = " KM";
if($user->language == "DE" || $user->language == "EN" ){
    $moneyType = " €";
}

$advertType = "Oglas prema kategoriji - Stellenanzeige i. d. Liste - Job Post inside Category";
if( $advert->type == 1){
    $advertType = "Platinum oglas - Platinum-Stellenanzeige - Platinum Campaign";
}else if($advert->type == 2){
    $advertType = "Izdvojeni oglas - Hervorgeh. Arbeitgeber - Featured Employer";
}
?>
<center>
Poštovani
<br>
<br>Sehr geehrte Damen und Herren
<br>
<br>Good day
<br>
<br><b><?= $user->company_name; ?></b>
<br>
<br>Vaš oglas je online.
<br>
Preuzmite Vas račun putem dolenavedenog linka.

<br>Link možete otvoriti ako ste logovani sa Vašim profilom.
<br>
<br>Im Link unten finden Sie Ihre Rechnung.

<br>Um den Link aufmachen zu können, loggen Sie sich zuerst auf diesem Gerät mit Ihrem Profil ein.
<br>
<br>You will find your invoice in the link below.

<br>In order to be able to open the link, first log into your profile with this device.
<br>
<br>
<a href="<?= Yii::$app->urlManager->createAbsoluteUrl(['site/html', 'id' => $advert->id]);?>">
  Račun - Rechnung - Invoice
</a>
<br>
<br>S poštovanjem
<br>
<br>MfG
<br>
<br>Best regards
<br>
<br>www.zaposljavanje.ba
</center>

<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */
/* @var $user common\models\Advert */
use yii\helpers\Url;

?>

<?php
$payment1 = "Po predračunu / uplatnicom";
$payment2 = "Banküberweisung";
$payment3 = "Payment / deposit slip";
if ($advert->payment == 3) {
    $payment1 = "Kreditna kartica";
    $payment2 = "Kreditkarte";
    $payment3 = "Credit card";
}

$moneyType = " KM";
if ($user->language == "DE" || $user->language == "EN") {
    $moneyType = " €";
}

$advertType1 = "Oglas prema kategoriji ";
$advertType2 = "Stellenanzeige i. d. Liste";
$advertType3 = "Job Post inside Category";

$advertType = $advertType1;
if ($user->language == "DE") {
    $advertType = $advertType2;
} else if ($user->language == "EN"){
    $advertType = $advertType3;
}

if ($advert->type == 1) {
    $advertType1 = "Platinum oglas";
    $advertType2 = "Platinum-Stellenanzeige";
    $advertType3 = "Platinum Campaign";
    $advertType = $advertType1;
    if ($user->language == "DE") {
        $advertType = $advertType2;
    } else if ($user->language == "EN"){
        $advertType = $advertType3;
    }
} else if ($advert->type == 2) {
    $advertType1 = "Izdvojeni oglas";
    $advertType2 = "Hervorgeh. Arbeitgeber";
    $advertType3 = "Featured Employer";
    $advertType = $advertType1;
    if ($user->language == "DE") {
        $advertType = $advertType2;
    } else if ($user->language == "EN"){
        $advertType = $advertType3;
    }
}



?>
<div style="background-color: white; font-family: Arial">

    <div style="margin:auto; width:794px; height:1122px;">

        <div style="width:100%; overflow: hidden; font-size: 10pt">
            <div style="width: 50%; float: left">
                <img style="width: 100%" src="<?= Url::to('@web/css/images/renesalis.jpg'); ?>">
            </div>
            <div style="width: 50%; float: left; text-align: center">
                <div>&nbsp;</div>
                <div>&nbsp;</div>
                <div><b>Renesalis d.o.o. - www.zaposljavanje.ba</b></div>
                <div>Igmanska bb, 71320 Vogošća, BiH</div>
                <div>Tel: 00387-62-332-325</div>
                <div>oglasi@zaposljavanje.ba</div>
            </div>
        </div>

        <br>

        <div style="width:100%; overflow: hidden; font-size: 8pt">
            <div style="width:100%; float: left">UniCredit Bank d.d. - IBAN: BA393387204834643060 - SWIFT: UNCRBA 22
            </div>
            <div style="width:100%; float: left">Broj računa - Kontonummer - Account number: 3387202234641771</div>
            <div style="width:75%; float: left">
                <div style="width:100%; float: left">ID broj - Firmennummer - Company ID number - 4202039860003</div>
                <div style="width:100%; float: left">PDV broj - Ust.Nummer - VAT number: 202039860003</div>
            </div>
            <div style="width:24%; float: right;  font-size: 10pt; border: 1px solid black; padding: 2px;">
                <div style="width:100%; float: left">Broj racuna: RZAP- <?= $advert->id; ?></div>
                <div style="width:100%; float: left"><?= Yii::$app->formatter->asDatetime($advert->start_advert, 'dd.MM.yyyy'); ?></div>
            </div>
        </div>

        <div style="width:100%; overflow: hidden; font-size: 11pt; text-align: center; border: 1px solid black; margin: 5px 0; padding: 2px 0;">
            <b>Račun - Rechnung - Invoice</b>
        </div>

        <div style="width:100%; overflow: hidden; font-size: 10pt; text-align: center; border: 1px solid black; margin: 5px 0; padding: 2px 0;">
            <b>Kupac - Käufer - Buyer</b>
        </div>

        <div style="width:100%; overflow: hidden; font-size: 10pt; border: 1px solid black;">
            <div style="width:60%; float: left; border-right: 1px solid black; padding: 5px;">
                <div style="width:100%;">Naziv firme - Firmenname - Company name:</div>
                <div style="width:100%;">Adresa - Firmenanschrift - Address:</div>
                <div style="width:100%;">Poštanski broj - Postleitzahl - Zip code:</div>
                <div style="width:100%;">&nbsp;</div>
                <div style="width:100%;">Kontakt osoba - Kontaktperson - Contact person:</div>
                <div style="width:100%;">e-mail:</div>
                <div style="width:100%;">Kontakt telefon - Telefonnummer - Phone number:</div>
                <div style="width:100%;">PDV broj - Ust.-Nummer - VAT number:</div>
            </div>
            <div style="width:36%; float: right; padding: 5px;">
                <div style="width:100%;"><?= $user->company_name; ?></div>
                <div style="width:100%;"><?= $user->address; ?></div>
                <div style="width:100%;"><?= $user->zip_code; ?></div>
                <div style="width:100%;">&nbsp;</div>
                <div style="width:100%;"><?= $user->full_name; ?></div>
                <div style="width:100%;"><?= $user->email; ?></div>
                <div style="width:100%;"><?= $user->phone; ?></div>
                <div style="width:100%;"><?= $user->pdv; ?></div>

            </div>
        </div>

        <br>

        <div style="width:100%; overflow: hidden; font-size: 10pt; border: 1px solid black;">
            <div style="width: 50%; float: left; border-right: 1px solid black; padding: 5px;">
                <div style="width:100%;">Način plaćanja:</div>
                <div style="width:100%;">Zahlungsart:</div>
                <div style="width:100%;">Method of payment:</div>
            </div>
            <div style="width: 46%; float: right; padding: 5px;">
                <div style="width:100%;"><?= $payment1; ?></div>
                <div style="width:100%;"><?= $payment2; ?></div>
                <div style="width:100%;"><?= $payment3; ?></div>
            </div>
        </div>

        <br>

        <div style="width:100%; overflow: hidden; font-size: 10pt; border: 1px solid black;">
            <div style="width:72%; float: left; border-right: 1px solid black; padding: 5px;">
                <div style="width:100%;">Vrsta oglasa - Stellenanzeige - Job posting:</div>
                <div style="width:100%;">Broj pozicija - Jobanzahl - Total number of jobs:</div>
                <div style="width:100%;">Trajanje oglasa - Dauer der Anzeigenschaltung - Total publication days:</div>
                <div style="width:100%;">&nbsp;</div>
                <div style="width:100%;">Valuta - Währung - Currency:</div>
                <div style="width:100%;">Ukupna cijena bez PDV-a - Gesamtpreis netto - Final net cost:</div>
                <div style="width:100%;">PDV 17% - USt 17% - VAT 17%:</div>
            </div>
            <div style="width:24%; float: right; padding: 5px;">
                <div style="width:100%;"><?= $advertType; ?></div>
                <div style="width:100%;"><?= $advert->number_of_positions; ?></div>
                <div style="width:100%;"><?= $advert->number_of_days; ?></div>
                <div style="width:100%;">&nbsp;</div>
                <div style="width:100%;"><?= $moneyType; ?></div>
                <div style="width:100%;"><?= round($advert->price / 1.17, 2); ?></div>
                <div style="width:100%;"><?= round($advert->price * 0.17 / 1.17, 2); ?></div>
            </div>
        </div>

        <div style="width:100%; overflow: hidden; font-size: 10pt; border: 2px solid black;">
            <div style="width:72%; float: left; border-right: 2px solid black; padding: 5px 4px 5px 5px; margin-left: 1px">
                <div style="width:100%;"><b>Ukupna cijena sa PDVom - Gesamtpreis inkl. USt - Final cost incl. VAT:</b>
                </div>
            </div>
            <div style="width:24%; float: right; padding: 5px;">
                <div style="width:100%;"><b><?= round($advert->price, 2); ?></b></div>
            </div>
        </div>

        <br>

        <div style="width:100%; overflow: hidden; font-size: 7pt;">
          Fakturu sa fiskalnim računom šaljemo Vam putem pošte u narednim danima.
        </div>
        <div style="width:100%; overflow: hidden; font-size: 7pt;">
          Wenn Sie eine Originalrechnung per Post verschickt haben möchten,
          lassen Sie es uns wissen:oglasi@zaposljavanje.ba
        </div>
        <div style="width:100%; overflow: hidden; font-size: 7pt;">
            In case you want us to send you the original invoice scanned by email or by postal service,
            let us know:oglasi@zaposljavanje.ba
        </div>

        <br>

        <div style="width:100%; overflow: hidden; font-size: 8pt;">
            <div style="width:60%; float: left">
                <div style="width:100%;">Broj (pred)računa je u isto vrijeme i broj narudžbe.</div>
                <div style="width:100%;">Rechnungsnummer ist Bestellnummer.</div>
                <div style="width:100%;">Invoice number equals order number.</div>
            </div>
            <div style="width:40%; float: left">
                <img style="width: 60%; float: right" src="<?= Url::to('@web/css/images/stembilj.jpg'); ?>">
            </div>
        </div>



        <div style="width:100%; overflow: hidden; font-size: 8pt;">
            <div style="width:100%;">Ovaj račun je elektronski napravljen i vrijedi kao ručno potpisan.</div>
            <div style="width:100%;">Diese Rechnung wurde elektronisch erstellt.</div>
            <div style="width:100%;">This invoice was created electronically.</div>
        </div>

    </div>
</div>

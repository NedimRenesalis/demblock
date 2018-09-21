
<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = 'Zapošljavanje';
?>


<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h3 class="text-center"><b>Produkte und Preise</b></h3>
                <br>Bei allen Preisangaben ist die bosnische USt. in Höhe von 17% miteingerechnet.
                <br>Alle Stellenanzeigen werden ebenfalls auf unseren Facebook- und Linkedin-Pages veröffentlicht.
              <br>Sämtliche Anzeigen können entweder umgehend mittels Kreditkarte auf unserer Seite oder per Proformarechnung bezahlt werden.
            </div>
        </div>
    </div>
</div>
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-4 text-justify">
                <img src="<?= Url::to('@web/css/images/price.png') ?>" class="img-responsive">
                <h3 class="text-center">
                    <strong>Stellenanzeige in der Liste</strong>
                </h3>
                <p class="text-center">Da wir eine Suchoption für verfügbare Stellenangebote anbieten, können
                    diese nach Beruf, Begriff und geografischer Lage aussortiert und in Form
                    einer Liste aufgelistet werden.
                    <br>
                    <br>30 Tage - 80 EUR (156,47 BAM)
                    <br>
                    <br>* * * *</p>
            </div>
            <div class="col-md-4 text-center">
                <img src="<?= Url::to('@web/css/images/price2.png') ?>" class="img-responsive">
                <h3 class="text-center">
                    <strong>Hervorgehobener Arbeitgeber</strong>
                </h3>
                <p class="text-justify">Diese Anzeigenart eignet sich hervorragend für Arbeitgeber, die gleichzeitig
                    mehr als eine Stellenanzeige aufgeben möchten.
                    <br>
                    <br>Die Positionierung dieser erfolgt für Besucher sehr gut sichtbar gleich
                    auf der ersten Seite, unter den Platinum Stellenanzeigen.</p>
                <br>- 1 Stellenanzeige - 30 Tage - 130 EUR
                <br>- 2 bis 5 Stellenanzeigen - 30 Tage - 230 EUR (449,84 BAM)
                <br>- 6 bis 10 Stellenanzeigen - 30 Tage - 305 EUR (596,53 BAM)
                <br>- Mehr als 11 Stellenanzeigen - 30 Tage - 340 EUR (664,98 BAM)
                <br>
                <br>* * * *</div>
            <div class="col-md-4 text-justify">
                <img src="<?= Url::to('@web/css/images/price3.png') ?>" class="img-responsive">
                <h3 class="text-center">
                    <strong>Platinum-Stellenanzeige</strong>
                </h3>
                <p class="text-center">Unsere Platinum-Stellenanzeige bietet bestmögliche Platzierung Ihrer Stellenanzeige
                    auf unserem Portal. Diese Anzeigenart befindet sich gleich auf der ersten
                    Seite unter der Suchmaske.
                    <br>
                    <br>
                    
                    <br>
                    <br>- 15 Tage: 200 EUR (391,17 BAM)
                    <br>
                    <br>- 30 Tage: 310 EUR (606,3 BAM)
                    <br>
                    <br>* * * *

                    <br>
                </p>
            </div>
        </div>
    </div>
</div>
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p class="text-center"><b>Bezahlung der Anzeigen</b>
                 <br>Wir bieten zwei Möglichkeiten der Bezahlung von Stellenanzeigen an: Mit Proformarechnung oder mit Kreditkarte.
                 <br>
                 <br>Im Falle, dass die Bezahlung mit Proformarechnung getätigt werden soll, schicken Sie bitte eine eMail an unseren Anzeigenverkauf  <a href="mailto:#">oglasi@zaposljavanje.ba</a> in deutscher Sprache mit gewünschtem Anzeigentyp und Anzeigendauer oder kontaktieren Sie uns per Telefon 00387-62-332-325. Nach Bezahlung der Proformarechnung, können Sie Ihre Anzeige auf unserer Website erstellen und sofort online stellen.
                 <br>
                 <br>Mit Kreditkarte bezahlte Anzeigen können ohne Kontakt mit unserem Anzeigenverkauf vollkommen automatisch auf unserer Webseite verfasst, bezahlt und sofort veröffentlicht werden.
                 <br>
<br><b>Wiederveröffentlichung von abgelaufenen Anzeigen</b>
<br>Alle abgelaufenen Anzeigen können problemlos im Profilbereich wieder veröffentlicht werden.
<br>
<br><b>Anonyme Stellenanzeigen</b>
                 <br>Wenn der Arbeitgeber aus subjektiven Gründen bei der Suche nach Arbeitskräften
                    anonym bleiben möchte, so bieten wir hier die Möglichkeit diese Zusatzoption
                    bei allen drei oben genannten Anzeigearten zusätzlich zu buchen. In diesem
                    Fall steht statt dem Logo und der Unternehmensangaben des Auftragsgebers
                    "Anonyme Anzeige - zaposljavanje.ba".</p>
                <p class="text-center">Der Aufpreis hierfür beträgt 70 EUR (136,9 BAM).</p>
            </div>
        </div>
    </div>
</div>
<div class="section section-success">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a class="active btn btn-block btn-primary" href="<?= Url::to('objava-oglasa'); ?>">Stellenanzeige schalten</a>
            </div>
        </div>
    </div>
</div>

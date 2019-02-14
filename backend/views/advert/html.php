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

    <div style="margin:auto; width:794px; height:1122px; ">

        <div style="width:100%; overflow: hidden; font-size: 10pt">
            <div style="width: 50%; float: left">
                <img style="width: 100%" src="<?= Url::to('@web/css/images/logo.png'); ?>">
            </div>
            <div style="width: 50%; float: left; text-align: center">
                <div>&nbsp;</div>
                <div>&nbsp;</div>
                <div><b>DemBlock</b></div>
                <div>Cayman Islands</div>
                
                <div>support@demblock.com</div>
            </div>
        </div>

        <br>

        <div style="width:100%; overflow: hidden; font-size: 8pt">
            <div style="width:100%; float: left">Decentralized Electronic Marketplace On The Blockchain
            </div>
            
            </div>
            <div style="width:24%; float: right;  font-size: 10pt; border: 1px solid black; padding: 2px;">
                <div style="width:100%; float: left">Invoice number<?= $advert->id; ?></div>
                <div style="width:100%; float: left"><?= Yii::$app->formatter->asDatetime($advert->created_at, 'dd.MM.yyyy'); ?></div>
            </div>
        </div>

        <div style="width:100%; overflow: hidden; font-size: 11pt; text-align: center; border: 1px solid black; margin: 5px 0; padding: 2px 0;">
            <b>Invoice</b>
        </div>

        <div style="width:100%; overflow: hidden; font-size: 10pt; text-align: center; border: 1px solid black; margin: 5px 0; padding: 2px 0;">
            <b>Buyer</b>
        </div>

        <div style="width:100%; overflow: hidden; font-size: 10pt; border: 1px solid black;">
            <div style="width:60%; float: left; border-right: 1px solid black; padding: 5px;">
                <div style="width:100%;">Company name:</div>
                <div style="width:100%;">Address:</div>
                <div style="width:100%;">Zip code:</div>
                <div style="width:100%;">&nbsp;</div>
                <div style="width:100%;">Contact person:</div>
                <div style="width:100%;">e-mail:</div>
                <div style="width:100%;">Phone number:</div>
              
            </div>
            <div style="width:37%; float: right; padding: 5px;">
                <div style="width:100%;"><?= $user->company_name; ?></div>
                <div style="width:100%;"><?= $user->address; ?></div>
                <div style="width:100%;"><?= $user->zip_code; ?></div>
                <div style="width:100%;">&nbsp;</div>
                <div style="width:100%;"><?= $user->full_name; ?></div>
                <div style="width:100%;"><?= $user->email; ?></div>
                <div style="width:100%;"><?= $user->phone; ?></div>
               

            </div>
        </div>

      
        <div style="width:100%; overflow: hidden; font-size: 10pt; border: 1px solid black;">
            <div style="width:70%; float: left; border-right: 1px solid black; padding: 5px;">
                
                <div style="width:100%;">Total publication days:</div>
                <div style="width:100%;">&nbsp;</div>
                
               
            </div>
            <div style="width:27%; float: right; padding: 5px;">
           
                <div style="width:100%;"><?= $advert->number_of_days; ?></div>
                <div style="width:100%;">&nbsp;</div>
             
               
            </div>
        </div>

        <div style="width:100%; overflow: hidden; font-size: 10pt; margin-right: -2px;
            border: 1px solid black; border-bottom: 2px solid black;">
            <div style="width:70%; float: left; border-right: 1px solid black; padding: 5px">
                <div style="width:100%;"><b>Final price in DemBlock tokens</b></div>
            </div>
            <div style="width:27%; float: right; padding: 5px;">
                <div style="width:100%;"><b><?= round($advert->price, 2); ?></b></div>
            </div>
        </div>

       
        <div style="width:100%; overflow: hidden; font-size: 8pt;">
            
           
        </div>

        <div style="width:100%; overflow: hidden; font-size: 8pt;">
            
            <div style="width:100%;">This invoice was created electronically by the DemBlock marketplace for product listing services.</div>
        </div>

    </div>
</div>

<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use kartik\datetime\DateTimePicker;
use dosamigos\ckeditor\CKEditor;

$this->title = 'Zapošljavanje';

$jobs = [
    "Agriculture" => "Agriculture",
    "Food & Beverage" => "Food & Beverage",
    "Apparel" => "Apparel",
    "Textile & Leather Products" => "Textile & Leather Products",
    "Fashion Accessories" => "Fashion Accessories",
    "Timepieces, Jewelry, Eyewear" => "Timepieces, Jewelry, Eyewear",
    "Automobiles" => "Automobiles",
    "Motorcycles" => "Motorcycles",
    "Transportation" => "Transportation",
    "Luggage" => "Luggage",
    "Bags" => "Bags",
    "Cases" => "Cases",
    "Shoes & Accessories" => "Shoes & Accessories",
    "Computer Software & Hardware" => "Computer Software & Hardware",
    "Home Appliance" => "Home Appliance",
    "Consumer Electronic" => "Consumer Electronic",
    "Security & Protection" => "Security & Protection",
    "Electrical Equipment & Supplies" => "Electrical Equipment & Supplies",
    "Telecommunication" => "Telecommunication",
    "Sports & Entertainment" => "Sports & Entertainment",
    "Gifts & Crafts" => "Gifts & Crafts",
    "Toys & Hobbies" => "Toys & Hobbies",
    "Health & Medical" => "Health & Medical",
    "Beauty & Personal Care" => "Beauty & Personal Care",
    "Construction & Real Estate" => "Construction & Real Estate",
    "Home & Garden" => "Home & Garden",
    "Lights & Lighting" => "Lights & Lighting",
    "Furniture" => "Furniture",
    "Machinery" => "Machinery",
    "Industrial Parts & Fabrication Services" => "Industrial Parts & Fabrication Services",
    "Tools" => "Tools",
    "Hardware" => "Hardware",
    "Measurement & Analysis Instruments" => "Measurement & Analysis Instruments",
    "Minerals & Metallurgy" => "Minerals & Metallurgy",
    "Chemicals" => "Chemicals",
    "Rubber & Plastics" => "Rubber & Plastics",
    "Energy" => "Energy",
    "Environment" => "Environment",
    "Packaging & Printing" => "Packaging & Printing",
    "Office & School Supplies" => "Office & School Supplies",
    "Service Equipment" => "Service Equipment",
];

$types = [
    1 => "Platinum oglas",
    2 => "Izdvojeni oglas",
    3 => "Oglas prema kategoriji",
];

$payments = [
    1 => "Uplatnica - Predračun",
    3 => "Kreditna kartica",
];

$days = [
    15 => "15 (samo za Platinum oglase)",
    30 => "30",
    40 => "40 (samo za Platinum oglase)",
];

?>

<div class="col-md-12">
    <h3 class="text-center">Objava oglasa</h3>
    <br>
  <center>    <br><b>Plaćanje oglasa</b>
  <br>Oglasi se mogu platiti odmah putem kreditne kartice online ili putem uplatnice na osnovu predračuna.
  <br>
  <br>Ako odaberete uplatu putem  uplatnice kontaktirate nas emailom na <a href="mailto:#">oglasi@zaposljavanje.ba</a> ili putem telefona na 062-332-325 za izdavanje predračuna. U email-u navedite ime Vaše firme i vrstu oglasa koji želite objaviti.
  <br>Nakon izvršene uplate i nakon što novac legne na naš račun, možete Vaš oglas na našoj stranici odmah sastaviti i objaviti.
  <br>
  <br>Plaćanje putem kreditne kartice na našoj stranici Vam omogućava da odmah sastavite i objavite oglas bez kontaktiranja naše oglasne službe.
<br>
<br><b>Anonimni oglas</b>
                  <br>U slučaju da poslodavac ne želi navesti svoj identitet u oglasu, postoji
                    mogućnost objave takozvanog anonimnog oglasa, gdje umjesto loga i imena
                    kompanije koja oglašava, stoji "zaposljavanje.ba za klijenta". Anonimni
                    oglas je moguć kao dodatna opcija za sve tri vrste oglasa.</p></center>
<br>
</div>
<div class="section text-justify">
    <div class="container">
        <div class="row">
            <?php if ($message != null): ?>
                <div class="form-group no-money">
                    <?= $message; ?>
                </div>
            <?php endif; ?>
            <?php $form = ActiveForm::begin(['fieldConfig' => ['template' => '{label}{input}']]); ?>
            <div class="row text-center">
                <div class="col-md-4">

                    <?= $form->field($model, 'anonymously')->checkbox(['label' => null])->label('Objavi oglas anonimno&nbsp;&nbsp;') ?>

                    <?= $form->field($model, 'position')->textInput(['maxlength' => true])->label('Pozicija') ?>

                    <?= $form->field($model, 'category')->dropDownList($jobs, ['prompt' => 'Odaberite kategoriju'])->label('Kategorija') ?>

                    <?= $form->field($model, 'number_of_positions')->textInput()->label('Broj pozicija') ?>

                </div>

                <div class="col-md-4">
                    <div class="form-group">

                        <?php echo '<label>Datum objave oglasa</label>'; ?>
                        <?php echo DateTimePicker::widget([
                            'model' => $model,
                            'attribute' => 'start_advert',
                            'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
                            'pluginOptions' => [
                                'autoclose' => true,
                                'startDate' => date('d-m-Y 00:00'),
                                'format' => 'd M yyyy, hh:ii'
                            ]
                        ]); ?>
                    </div>

                    <?= $form->field($model, 'contact_person')->textInput(['maxlength' => true])->label('Kontakt osoba') ?>

                    <?= $form->field($model, 'contact_email')->textInput(['maxlength' => true])->label('Kontakt email') ?>

                    <?= $form->field($model, 'web_address')->textInput(['maxlength' => true])->label('Web adresa') ?>

                </div>

                <div class="col-md-4">
                    <?= $form->field($model, 'location')->textInput(['maxlength' => true])->label('Grad') ?>

                    <?= $form->field($model, 'type')->dropDownList($types, ['prompt' => 'Odaberite tip oglasa'])->label('Vrsta oglasa') ?>

                    <?= $form->field($model, 'number_of_days')->dropDownList($days, ['prompt' => 'Odaberite'])->label('Trajanje oglasa (u danima)') ?>

                    <?= $form->field($model, 'payment')->dropDownList($payments, ['prompt' => 'Odaberite način plaćanja'])->label('Plaćanje') ?>
                </div>
            </div>

            <div class="col-lg-2"></div>
            <div class="col-lg-8 advert-description">
                <?= $form->field($model, 'description')->widget(CKEditor::className(), [
                    'options' => [
                            'rows' => 2,
                    ],
                    'preset' => 'advanced',
                    'clientOptions' => [
                            'language'=>'hr'
                    ]

                ])->label('Opis'); ?>
            </div>
            <div class="col-lg-2"></div>
        </div>
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="form-group">
                            <?= Html::submitButton('Objavi', ['class' => 'btn btn-primary']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

<?php if (!$isEmployer): ?>
    <div class="just-for-employers-wrapper">
        <div class="just-for-employers">
            Ova prijava je samo za poslodavce.
        </div>
    </div>
<?php endif; ?>


<script>

    $(document).ready(function () {
        $("#advert-anonymously").on("click", function () {

            if ($('#advert-anonymously').is(':checked')) {
                $("#advert-contact_person").val("-").prop("disabled", true);
                $("#advert-contact_email").val("-").prop("disabled", true);
                $("#advert-web_address").val("-").prop("disabled", true);
            } else {
                $("#advert-contact_person").val("").prop("disabled", false);
                $("#advert-contact_email").val("").prop("disabled", false);
                $("#advert-web_address").val("").prop("disabled", false);
            }

        });
    });
</script>

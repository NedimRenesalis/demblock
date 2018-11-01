<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use frontend\assets\UploadAsset;
use kartik\file\FileInput;
use kartik\datetime\DateTimePicker;
use dosamigos\ckeditor\CKEditor;

$this->title = 'Zapošljavanje';

UploadAsset::register($this);
$script = <<< JS
$(document).ready(function() {
    $('#upload-data').yiiActiveForm('add',
        {
            "id":"AdvertImage-imagesgallery",
            "name":"imagesGallery[]",
            "container":".field-advertimage-imagesgallery",
            "input":"#advertimage-imagesgallery",
            "error":".help-block.help-block-error",
            "validate":function (attribute, value, messages, deferred) {
                if ($('.file-preview-frame').length == 0) {
                    yii.validation.required(value, messages, {"message": $('#upload-data').data('err-msg-gallery')});
                }
                if ($('.file-preview-frame').length > 20) {
                    yii.validation.addMessage(messages, $('#upload-data').data('err-msg-img-limit'), value);
                }
            }
        }
    );
}); 
JS;


$types = [
    1 => "Platinum-Stellenanzeige",
    2 => "Hervorgeh. Arbeitgeber",
    3 => "Stellenanzeige i. d. Liste",
];

$payments = [
    1 => "Vorauszahlung  - bereits geleistet",
    3 => "Kreditkarte",
];

$days = [
    15 => "15 (nur für Platinum)",
    30 => "30"
];

$jobs = [
    "Ostala zanimanja" => "Andere Berufe",
    "Savjetovanje - Consulting usluge" => "Beratung - Consulting",
    "Informatika - Hardware" => "IT - Hardware",
    "Informatika - Software" => "IT - Software",
    "Proizvodnja" => "Produktion",
    "Zanati" => "Handwerk",
    "Management" => "Management",
    "Poduzetništvo" => "Unternehmertum",
    "Grafika i dizajn" => "Grafik und Design",
    "Ljudski resursi - Human Resources - HR" => "Human Resources - HR",
    "Knjigovodstvo – Revizija - Controlling" => "Buchhaltung - Revision - Controlling",
    "Administrativne Usluge" => "Administrative Tätigkeiten",
    "Prodaja - Komercijala" => "Sales - Verkauf",
    "Nabavka - Supply Chain Management" => "Beschaffung - Supply Chain Management",
    "Transport - Logistika" => "Transport - Logistik",
    "Sekretarski poslovi - Asistencija" => "Assistenztätigkeiten",
    "Arhitektonske Usluge" => "Architektur",
    "Finansije i Bankarstvo" => "Finanz und Banking",
    "Osiguranja" => "Versicherungen",
    "Farmacija i Biotehnologija" => "Pharmazie und Biotechnologie",

    "Ekonomija" => "Wirtschaft",
    "Elektrotehnika - Mašinstvo" => "Elektrotechnik - Maschinenbau",
    "Energetika" => "Energiewirtschaft",
    "Građevinarstvo" => "Bau",
    "Ljepota i Zdravlje" => "Schönheit und Gesundheit",
    "Odnosi sa Javnošću - PR" => "Öffentlichkeitsarbeit - PR",
    "Mediji" => "Medien",
    "Nauka - Istraživački Radovi" => "Wissenschaft",
    "Nekretnine" => "Immobilien",

    "Zaštitarske Usluge" => "Security",
    "Rudarstvo" => "Bergbau",
    "Industrija" => "Industrie",
    "Trgovina" => "Handel",
    "Zastupanje" => "Vertretertätigkeiten",
    "Socijalne Usluge" => "Sozialarbeit",
    "NVO - Nevladine Organizacije" => "NGO",
    "Telekomunikacije" => "Telekommunikation",
    "Turizam - Ugostiteljstvo - Hotelijerstvo" => "Tourismus",
    "Veterina" => "Tiermedizin",
    "Zabava" => "Unterhaltung",
    "Pravne Usluge" => "Rechtsbezogene Dienstleistungen"
];

?>

<div class="col-md-12">
    <h3 class="text-center">Stellenanzeige aufgeben</h3>
  <br>
 <center><br>Bei allen Preisangaben ist die bosnische USt. in Höhe von 17% miteingerechnet.

  <br>
  <br>
  <b>Bezahlung der Anzeigen</b>
   <br>Wir bieten zwei Möglichkeiten der Bezahlung von Stellenanzeigen an: Mit Proformarechnung (Vorauszahlung) oder mit Kreditkarte.
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
      "Anonyme Anzeige - zaposljavanje.ba".</p></center>
      <br>
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
            <?php 
                $form = ActiveForm::begin([
                    'options' => [
                        'enctype' => 'multipart/form-data',
                        'data-company'   => $advert_id,
                        'data-err-msg-gallery' => t('app', 'Please add at least your ICOs logo. Besides you can upload additional 19 pictures, screenshots, graphics.'),
                        'data-err-msg-img-limit' => t('app', 'The number of uploaded images exceeds the maximum allowed limit of {limitNumber} images', [
                            'limitNumber' => 20,
                        ]),
                    ],
                    'id'        => 'upload-data',
                    'method'    => 'post',
                    'fieldConfig' => ['template' => '{label}{input}']]); 
            ?>
            <div class="row text-center">
                <div class="col-md-4">

                    <?= $form->field($model, 'anonymously')->checkbox(['label' => null])->label('Anonymisierte Stellenanzeige schalten&nbsp;&nbsp;') ?>

                    <?= $form->field($model, 'position')->textInput(['maxlength' => true])->label('Jobtitel') ?>

                    <?= $form->field($model, 'category')->dropDownList($jobs, ['prompt' => 'Berufsfeld auswählen'])->label('Berufsfeld auswählen') ?>

                    <?= $form->field($model, 'number_of_positions')->textInput()->label('Anzahl der zu besetzenden Stellen') ?>

                </div>

                <div class="col-md-4">
                    <div class="form-group">

                        <?php echo '<label>Datum der Veröffentlichung</label>'; ?>
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

                    <?= $form->field($model, 'contact_person')->textInput(['maxlength' => true])->label('Ansprechperson') ?>

                    <?= $form->field($model, 'contact_email')->textInput(['maxlength' => true])->label('e-Mail für ankommende Bewerbungen') ?>

                    <?= $form->field($model, 'web_address')->textInput(['maxlength' => true])->label('Webadresse') ?>


                </div>

                <div class="col-md-4">
                    <?= $form->field($model, 'location')->textInput(['maxlength' => true])->label('Ort, Region') ?>

                    <?= $form->field($model, 'type')->dropDownList($types, ['prompt' => 'Art der Stellenanzeige'])->label('Art der Stellenanzeige') ?>

                    <?= $form->field($model, 'number_of_days')->dropDownList($days, ['prompt' => 'Wählen'])->label('Dauer der Anzeigenschaltung') ?>

                    <?= $form->field($model, 'payment')->dropDownList($payments, ['prompt' => 'Zahlungsart'])->label('Zahlungsart') ?>

                </div>
            </div>

            <div class="col-lg-2"></div>
            <div class="col-lg-8 advert-description">
            <?php 
                    $imagesPreview = [];
                    $imagesPreviewConfig = [];
                    if ($action == 'update') {
                        // sort for images sort_order
                        usort($uploadedImages, function ($a, $b) { 
                            if($a != null && $b != null) return strnatcmp($a['sort_order'], $b['sort_order']); 
                        });
                        if ($uploadedImages) foreach ($uploadedImages as $key => $image) {
                            $imagesPreview[] =  Url::base('') . $image->image_path;
                            $imagesPreviewConfig[$key]['caption'] = $image->image_path;
                            $imagesPreviewConfig[$key]['url'] = url(['/remove-photo']);
                            $imagesPreviewConfig[$key]['key'] = $image->image_id;
                        }
                    }
                    
                    echo $form->field($images, 'image_form_key', [
                        'template' => '{input} {error}',
                        'options'    => ['style' => 'display:none'],
                    ])->hiddenInput(['value'=> $image_random_key, 'class' => 'form-control'])->label(false);

                    echo $form->field($images, 'imagesGallery[]')->widget(FileInput::classname(), [
                        'options' => [
                            'multiple'                  => true,
                            'accept'                    => 'image/*',
                            'class'                     =>'file-loading',
                            'data-sort-company-images'  => url(['/sort-photos'])
                        ],
                        'pluginOptions' => [
                            'initialPreview'=> $imagesPreview,
                            'initialPreviewConfig' =>
                                $imagesPreviewConfig
                            ,
                            'initialPreviewAsData'=>true,
                            'uploadUrl' => url(['/upload-photos']),
                            'uploadExtraData' => [
                                'image_form_key' => $image_random_key,
                                'action' => $action,
                                'adId'  => $advert_id,
                            ],
                            'uploadAsync' => true,
                            'allowedFileTypes' => ["image"],

                            'showUpload' => false,
                            'showRemove' => false,
                            'showClose' => false,
                            'showCancel' => false,
                            'browseOnZoneClick' => true,
                            'dropZoneEnabled' => false,

                            'browseLabel' => t('app', 'Upload files'),
                            'browseClass' => 'btn btn-success',
                            'uploadClass' => 'btn btn-info',
                            'removeClass' => 'btn btn-danger ',
                            'removeIcon' => '<i class="glyphicon glyphicon-trash"></i> ',
                            'msgPlaceholder' => t('app', 'Select files...'),
                            'captionClass'  => [
                                    'height' => '100px'
                            ],
                            'layoutTemplates' =>
                                [
                                    'fileIcon' => ''
                                ],
                            'fileActionSettings' => [
                                'showUpload' => false,
                                'showZoom' => true,
                                'zoomClass' => 'btn btn btn-kv btn-default btn-outline-secondary zoombtn',
                                'showDrag' => true,
                            ],
                            'maxFileCount' => 20,
                    
                            'validateInitialCount'=> true,
                            'overwriteInitial'=>false,
                        ]
                    ])->label(false);
                ?>
                <?= $form->field($model, 'description')->widget(CKEditor::className(), [
                    'options' => ['rows' => 2],
                    'preset' => 'advanced',
                    'clientOptions' => [
                        'language' => 'de'
                    ]
                ])->label('Beschreibung'); ?>
            </div>
            <div class="col-lg-2"></div>
        </div>
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="form-group">
                            <?= Html::submitButton('Stellenanzeige aufgeben', ['class' => 'btn btn-primary']) ?>
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
            Dieser Login ist nur für Arbeitgeber.
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

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
    1 => "Platinum Campaign",
    2 => "Featured Employer",
    3 => "Job Post inside Category",
];

$payments = [
    1 => "Payment/ deposit slip",
    3 => "Creditcard",
];

$days = [
    15 => "15 (only for Platinum)",
    30 => "30"
];

$jobs = [
    "Ostala zanimanja" => "Other",
    "Savjetovanje - Consulting usluge" => "Consulting",
    "Informatika - Hardware" => "IT - Hardware",
    "Informatika - Software" => "IT - Software",
    "Proizvodnja" => "Manufacturing",
    "Zanati" => "Handcraft",
    "Management" => "Management",
    "Poduzetništvo" => "Entrepreneurship",
    "Grafika i dizajn" => "Graphics and Design",
    "Ljudski resursi - Human Resources - HR" => "Human Resources - HR",
    "Knjigovodstvo – Revizija - Controlling" => "Accounting - Controlling",
    "Administrativne Usluge" => "Administrative Jobs",
    "Prodaja - Komercijala" => "Sales",
    "Nabavka - Supply Chain Management" => "Supply Chain Management",
    "Transport - Logistika" => "Transport - Logistics",
    "Sekretarski poslovi - Asistencija" => "Assistant",
    "Arhitektonske Usluge" => "Architecture",
    "Finansije i Bankarstvo" => "Finance and Banking",
    "Osiguranja" => "Insurance",
    "Farmacija i Biotehnologija" => "Pharmacy and Biotech",

    "Ekonomija" => "Business Administration",
    "Elektrotehnika - Mašinstvo" => "Electrical and Mechanical Engineering",
    "Energetika" => "Energy Sector",
    "Građevinarstvo" => "Building Industry",
    "Ljepota i Zdravlje" => "Beauty and Health",
    "Odnosi sa Javnošću - PR" => "Public Relations - PR",
    "Mediji" => "Media",
    "Nauka - Istraživački Radovi" => "Science and Research",
    "Nekretnine" => "Real Estate",

    "Zaštitarske Usluge" => "Security Services",
    "Rudarstvo" => "Mining",
    "Industrija" => "Industrial Production and Services",
    "Trgovina" => "Trade",
    "Zastupanje" => "Sales and Commercial Representatives",
    "Socijalne Usluge" => "Social Services",
    "NVO - Nevladine Organizacije" => "NGO",
    "Telekomunikacije" => "Telecommunications",
    "Turizam - Ugostiteljstvo - Hotelijerstvo" => "Tourism",
    "Veterina" => "Veterinary Medicine",
    "Zabava" => "Leisure",
    "Pravne Usluge" => "Legal Services"
];
?>


<div class="col-md-12">
    <h3 class="text-center">Post a job</h3>
</div>
<div class="section text-justify">
    <div class="container">
        <div class="row">
            <?php if ($message != null): ?>
                <div  class="form-group no-money">
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

                    <?= $form->field($model, 'anonymously')->checkbox(['label' => null])->label('Anonymous Job Posting&nbsp;&nbsp;') ?>

                    <?= $form->field($model, 'position')->textInput(['maxlength' => true])->label('Job title') ?>

                    <?= $form->field($model, 'category')->dropDownList($jobs, ['prompt' => 'Sector'])->label('Choose') ?>

                    <?= $form->field($model, 'number_of_positions')->textInput()->label('Total number of jobs') ?>

                </div>

                <div class="col-md-4">
                    <div class="form-group">

                        <?php echo '<label>Publication Date</label>'; ?>
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

                    <?= $form->field($model, 'contact_email')->textInput(['maxlength' => true])->label('e-mail address for incoming applications') ?>

                    <?= $form->field($model, 'web_address')->textInput(['maxlength' => true])->label('Web Site') ?>

                    <?= $form->field($model, 'contact_person')->textInput(['maxlength' => true])->label('Contact person') ?>


                </div>

                <div class="col-md-4">
                    <?= $form->field($model, 'location')->textInput(['maxlength' => true])->label('Location') ?>

                    <?= $form->field($model, 'type')->dropDownList($types, ['prompt' => 'Type'])->label('Type of job classified') ?>

                    <?= $form->field($model, 'number_of_days')->dropDownList($days, ['prompt' => 'Choose'])->label('Total publication days') ?>

                    <?= $form->field($model, 'payment')->dropDownList($payments, ['prompt' => 'Select'])->label('Method of payment') ?>

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
                        'language'=>'en'
                    ]
                ])->label('Job posting details'); ?>
            </div>
            <div class="col-lg-2"></div>
        </div>
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="form-group">
                            <?= Html::submitButton('Publish job posting', ['class' => 'btn btn-primary']) ?>
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
            Employer only login.
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

<?php
use yii\helpers\Url;
use frontend\assets\UploadAsset;
use kartik\file\FileInput;
use yii\widgets\ActiveForm;

use yii\helpers\Html;
use kartik\datetime\DateTimePicker;
use dosamigos\ckeditor\CKEditor;
use frontend\models\Categories;

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


$categories = Categories::find()->where(["ParentId" => null])->orderBy(['Name' => SORT_ASC])->all();
$jobs = [];
foreach ($categories as $category) {
    $jobs[$category->Name] = $category->Name;
}
$subCategoriesSelected = [];
if($model && $model->category) {
    $parent = Categories::find()->where(['like', 'Name', $model->category])->one();
    if ($parent) {
        $pid = $parent['Id'];
        $subCategories = Categories::find()->where(['ParentId' => $pid])->orderBy(['Name' => SORT_ASC])->all();
        if (sizeof($subCategories) > 0) {

            foreach ($subCategories as $subCategory) {
                $subCategoriesSelected[$subCategory->Name] = $subCategory->Name;
            }
        }
    }
}

$types = [
    1 => "PRIME LISTING",
    2 => "SELECTED LISTING",
    3 => "CLASSIC LISTING",
];

$payments = [
    1 => "CLICK HERE TO CHOOSE PAYMENT WITH TOKENS",
   
];

$days = [
    15 => "15 days - only for PRIME LISTING available",
    30 => "30 days",
    40 => "40 days - only for PRIME LISTING available",
];

?>

<div class="col-md-12">
    <b><h3 class="text-center">PRODUCT LISTING</h3></b>
   
  
 <br> 
 <br>
<br>
</div>
<div class="section text-justify">
<br> 

<br>
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
                        'data-err-msg-img-limit' => t('app', 'The number of uploaded images exceeds the maximum allowed limit of {limitNumber} images', [
                            'limitNumber' => 20,
                        ]),
                    ],
                    'id'        => 'upload-data',
                    'method'    => 'post',
                    'fieldConfig' => ['template' => '{label}{input}']]); 
            ?>
            <div class="row text-center">
                <div class="col-md-6">

                   



                    <?= $form->field($model, 'category')->dropDownList($jobs, ['prompt' => 'SELECT', 'label' => null,
                            'onchange' => '
                                                        $.post(
                                                            "' . Url::toRoute('get-subcategories') . '", 
                                                            {selected: $(this).val()}, 
                                                                function(res){
                                                                console.log(res);
                                                                console.log($("#advert-position"));
                                                                    $("#advert-position").html(res);
                                                                    console.log($("#advert-position"));
                                                            }
                                                        );
                                                    ']
                        )->label("PRODUCT OR CATEGORY") ?>

                    <?= $form->field($model, 'position')->dropDownList($subCategoriesSelected,['prompt' => "SELECT"])->label('SUBCATEGORY') ?>

 <?= $form->field($model, 'location')->textInput(['maxlength' => true])->label('SHIPPING FROM') ?>

<?= $form->field($model, 'type')->dropDownList($types, ['prompt' => 'LISTING TYPE'])->label('CHOOSE LISTING TYPE') ?>
<?= $form->field($model, 'number_of_days')->dropDownList($days, ['prompt' => 'LISTING DURATION'])->label('CHOOSE LISTING DURATION') ?>

                </div>

                <div class="col-md-6">
                    <div class="form-group">

                        <?php echo '<label>CHOOSE LISTING STARTING DATE</label>'; ?>
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

                    <?= $form->field($model, 'contact_person')->textInput(['maxlength' => true])->label('CONTACT PERSON') ?>

                    <?= $form->field($model, 'contact_email')->textInput(['maxlength' => true])->label('EMAIL') ?>

                    <?= $form->field($model, 'web_address')->textInput(['maxlength' => true])->label('PRODUCT URL ON YOUR CORPORATE WEBSITE') ?>
                    <?= $form->field($model, 'payment')->dropDownList($payments, ['prompt' => 'PAY WITH TOKENS'])->label('PAYMENT') ?>
                </div>

                <div class="col-md-6">
                   

                 

                  
                </div>
            </div>
<br>
<br>
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

                            'browseLabel' => t('app', 'CLICK TO UPLOAD'),
                            'browseClass' => 'btn btn-success',
                            'uploadClass' => 'btn btn-info',
                            'removeClass' => 'btn btn-danger ',
                            'removeIcon' => '<i class="glyphicon glyphicon-trash"></i> ',
                            'msgPlaceholder' => t('app', 'Upload upto 20 sreenshots, pictures, graphics'),
                            'captionClass'  => [
                                    'height' => '150px'
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
                    'options' => [
                            'rows' => 2,
                    ],
                    'preset' => 'advanced',
                    'clientOptions' => [
                            'language'=>'en'
                    ]
                    
                ])->label('PRODUCT DETAILS<br><br>Please insert below short product description, minimum order quantity, lead time, packaging and delivery options and FAQ. <br>'); ?><br>
            </div>          

           
        </div>
        <div class="section"> 
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="form-group"><br>
                            <?= Html::submitButton('PUBLISH PRODUCT LISTING', ['class' => 'btn btn-primary']) ?>
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
            Please first log in before listing product.
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

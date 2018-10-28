<?php
use frontend\assets\UploadAsset;
use yii\bootstrap\Html;
use kartik\file\FileInput;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = 'Zapošljavanje';

UploadAsset::register($this);
$script = <<< JS
$(document).ready(function() {
    $('#upload-data').yiiActiveForm('add',
        {
            "id":"companyimage-imagesgallery",
            "name":"imagesGallery[]",
            "container":".field-companyimage-imagesgallery",
            "input":"#companyimage-imagesgallery",
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
$this->registerJs($script, yii\web\View::POS_LOAD);
$form = ActiveForm::begin([
    'options' => [
        'enctype' => 'multipart/form-data',
        'data-company'   => $user_id,
        'data-err-msg-gallery' => t('app', 'Please add at least your ICOs logo. Besides you can upload additional 19 pictures, screenshots, graphics.'),
        'data-err-msg-img-limit' => t('app', 'The number of uploaded images exceeds the maximum allowed limit of {limitNumber} images', [
            'limitNumber' => 20,
        ]),
    ],
    'id'        => 'upload-data',
    'method'    => 'post',
    'action'    => 'upload-logo'
]);  ?>
<br>
<div class="container">
    <h3>Prenesite logo</h3>
    <br>
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
                    'adId'  => $user_id,
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
<ul>
</ul>
</div>
<?php ActiveForm::end(); ?>
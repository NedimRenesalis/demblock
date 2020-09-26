<?php

use frontend\assets\UploadAsset;
use yii\helpers\Url;

use yii\helpers\Html;

UploadAsset::register($this);
$this->title = 'demblock';

use yii\widgets\ActiveForm;
?>

<div class="container">
    <br>
    <div class="alert" id="msg-upload-status" style="display: none;">
    </div>
</div>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'id' => 'upload']]); ?>
<div id="drop">DROP LOGO HERE OR <br>
    <a>CHOOSE FILE</a>
    <?= $form->field($item, 'file')->fileInput()->label("") ?>
    (MAX 2MB)<br />


</div>

<ul>
    <!-- The file uploads will be shown here -->
</ul>

<a href="<?= Url::to('profil-poslodavac') ?>" class="btn btn-primary" style="font-size: 16px;color: white;padding: 14px;">TO PROFILE</a>

<?php ActiveForm::end(); ?>
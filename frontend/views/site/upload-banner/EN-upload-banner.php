<?php
use frontend\assets\UploadAsset;

UploadAsset::register($this);

$this->title = 'Zapošljavanje';

use yii\widgets\ActiveForm;

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'id' => 'upload']]); ?>
<div id="drop">Pull banner into this field or
    <a>choose banner</a>
    <?= $form->field($item, 'file')->fileInput()->label("") ?>
    (MAX 2MB)<br/>(930px x 200px)

</div>
<ul>
    <!-- The file uploads will be shown here -->
</ul>

<?php ActiveForm::end(); ?>

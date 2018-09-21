<?php
use frontend\assets\UploadAsset;

UploadAsset::register($this);

$this->title = 'Zapošljavanje';

use yii\widgets\ActiveForm;

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'id' => 'upload']]); ?>
<div id="drop">Pull document into this field or
    <a>choose document</a>
    <?= $form->field($item, 'file')->fileInput()->label("") ?>
    (MAX 10MB)<br/>
    You can upload your CV in .PDF, ,DOC and .DOCX
</div>
<ul>
    <!-- The file uploads will be shown here -->
</ul>

<?php ActiveForm::end(); ?>

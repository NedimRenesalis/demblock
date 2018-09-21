<?php
use frontend\assets\UploadAsset;

UploadAsset::register($this);

$this->title = 'Zapošljavanje';

use yii\widgets\ActiveForm;

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'id' => 'upload']]); ?>

<div id="drop">Prenesite dokument ovde ili
    <a>Odaberite dokument</a>
    <?= $form->field($item, 'file')->fileInput()->label("") ?>
    (MAX 10MB)<br/>
    CV uploadovati u formatima: .PDF, .DOC i .DOCX
</div>
<ul>
    <!-- The file uploads will be shown here -->
</ul>

<?php ActiveForm::end(); ?>

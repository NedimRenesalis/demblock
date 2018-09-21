<?php
use frontend\assets\UploadAsset;

UploadAsset::register($this);

$this->title = 'Zapošljavanje';

use yii\widgets\ActiveForm;

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'id' => 'upload']]); ?>
<div id="drop">Dokument in dieses Feld ziehen oder
    <a>Dokument auswählen</a>
    <?= $form->field($item, 'file')->fileInput()->label("") ?>
    (MAX 10MB)<br/>
    Den Lebenslauf können Sie in folgenden Formaten uploaden: PDF, .DOC. und DOCX.
</div>
<ul>
    <!-- The file uploads will be shown here -->
</ul>

<?php ActiveForm::end(); ?>

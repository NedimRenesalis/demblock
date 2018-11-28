<?php
use frontend\assets\UploadAsset;

UploadAsset::register($this);
$this->title = 'Zapošljavanje';

use yii\widgets\ActiveForm;
$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'id' => 'upload']]);?>
<div id="drop">DROP LOGO HERE OR <br>
    <a>CHOOSE FILE</a>
    <?= $form->field($item, 'file')->fileInput()->label("") ?>
    (MAX 2MB)<br/>
</div>

<ul>
    <!-- The file uploads will be shown here -->
</ul>

<?php ActiveForm::end(); ?>
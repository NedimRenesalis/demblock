<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\assets\UploadAsset;

UploadAsset::register($this);

/* @var $this yii\web\View */
/* @var $model app\models\UserContactInformation */
/* @var $form ActiveForm */
?>
<?php
$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'id' => 'upload']]);?>

<div id="drop">Prenesite logo ovde ili
    <a>Odaberite logo</a>
    <?= $form->field($item, 'file')->fileInput()->label("") ?>
               (MAX 2MB)<br/>
</div>

<ul>
    <!-- The file uploads will be shown here -->
</ul>

<?php ActiveForm::end(); ?>
<div class="site-user-profile-user-contact">
    <div class="row">

        <div class="col-md-4">
            <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'first_name') ?>
            <?= $form->field($model, 'last_name') ?>
            <?= $form->field($model, 'mainProducts')->textarea() ?>

            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary', 'id' => 'uploadImageMainDetails']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div><!-- site-user-profile-user-contact -->

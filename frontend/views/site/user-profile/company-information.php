<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\CompanyInformation */
/* @var $form ActiveForm */
?>
<div class="site-user-profile-company-information">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo DatePicker::widget([
        'model' => $model,
        'attribute' => 'Year',
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
    ]); ?>
        <?= $form->field($model, 'NumberOfEmployees')->textInput(['type' => 'number', 'min' => 0]) ?>
        <?= $form->field($model, 'AboutUs') ?>
        <?= $form->field($model, 'CompanyName') ?>
        <?= $form->field($model, 'Website') ?>
        <?= $form->field($model, 'RegisteredAddress') ?>
        <?= $form->field($model, 'OperationalAddress') ?>
    
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-user-profile-company-information -->

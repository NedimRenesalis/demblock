<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Categories;

/* @var $this yii\web\View */
/* @var $model backend\models\Categories */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categories-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Name')->textInput(['maxlength' => true]) ?>


    <?php
        $categories = Categories::find()->where(['ParentId' => NULL])->orderBy(['Name' => SORT_ASC])->all();
        $listData = ArrayHelper::map($categories, 'Id','Name');

    ?>
    <?= $form->field($model, 'ParentId')->dropDownList($listData, ['prompt' => 'Select Parent Category']); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

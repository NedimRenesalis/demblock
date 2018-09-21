<?php
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Zapošljavanje';

$genders = ['Male' => 'Male', 'Female' => 'Female'];
?>
<div class="section" id="registration-page">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center">Profile employee</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <img src="<?= Url::to('@web/css/images/registration-employee-left.jpg'); ?>" class="img-responsive">
            </div>
            <div class="col-md-4 text-center">
                <?php $form = ActiveForm::begin(['id' => 'register-employee-form', 'action' => ['site/profil-poslodavac']]); ?>

                <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>"/>

                <?php if ($model->image != null): ?>
                    <div class="form-group">
                        <div class="col-sm-12 text-center cv">
                          CV has been uploaded.
                        </div>
                    </div>
                <?php else: ?>
                    <div class="form-group">
                        <div class="col-sm-12 text-center missing-cv">
                            CV hasn't been uploaded yet.
                        </div>
                    </div>
                <?php endif; ?>


                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'first_name')->textInput()->label('Name') ?>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'last_name')->textInput()->label('Surname') ?>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'email')->textInput(['disabled' => true])->label('Email address') ?>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'year_of_birth')->textInput()->label('Year of birth') ?>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'gender')->dropDownList($genders, ['prompt' => 'Choose gender'])->label('Gender') ?>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'zip_code')->textInput()->label('Zip code') ?>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'education_level')->textInput()->label('Education level') ?>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'career_level')->textInput()->label('Current career level') ?>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'additional_experience')->textarea()->label('Additional experience') ?>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'phone')->textInput()->label('Phone number') ?>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12 col-sm-offset- text-center">
                        <input type="submit" class="active btn btn-block btn-info" value="Save changes"/>

                    </div>
                </div>
                <?php ActiveForm::end(); ?>

                <div class="form-group">
                    <div class="col-sm-12 col-sm-offset- text-center">
                        <a href="<?= Url::to('upload-cv'); ?>" class="active btn btn-block btn-success">
                            Upload your CV here<a/>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <img src="<?= Url::to('@web/css/images/registration-employee-right.jpg'); ?>" class="img-responsive">
            </div>
        </div>
    </div>
</div>

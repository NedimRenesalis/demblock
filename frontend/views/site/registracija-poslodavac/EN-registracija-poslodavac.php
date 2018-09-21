<?php
use yii\helpers\Url;
use yii\widgets\ActiveForm;

use dosamigos\ckeditor\CKEditor;
use yii\captcha\Captcha;

$this->title = 'Zapošljavanje';
?>
<div class="section" id="registration-page">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center">Employers Sign Up</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <img src="<?= Url::to('@web/css/images/registration-left.jpg'); ?>" class="img-responsive">
            </div>
            <div class="col-md-4 text-center">
                <?php $form = ActiveForm::begin(['id' => 'register-employee-form', 'action' => ['site/registracija-poslodavac', ], 'fieldConfig' => ['template' => '{label}{input}']]); ?>

                <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>"/>
                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'full_name')->textInput()->label('Contact person') ?>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'email')->textInput()->label('Email') ?>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'company_name')->textInput()->label('Company name') ?>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'address')->textInput()->label('Address') ?>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'zip_code')->textInput()->label('Zip Code') ?>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'phone')->textInput()->label('Phone number') ?>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'pdv')->textInput()->label('VAT number') ?>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'company_description')->widget(CKEditor::className(), [
                            'options' => [
                                'rows' => 6,
                            ],
                            'preset' => 'advanced',
                            'clientOptions' => [
                                'language'=>'en'
                            ]

                        ])->label('Company details'); ?>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'password')->passwordInput()->label('Password') ?>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'confirm_password')->passwordInput()->label('Repeat password') ?>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'captcha')->widget(Captcha::className())->label('Enter text ') ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12 col-sm-offset- text-center">
                        <input type="submit" class="active btn btn-block btn-info" value="Sign up"/>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
            <div class="col-md-4">
                <img src="<?= Url::to('@web/css/images/registration-right.jpg'); ?>" class="img-responsive">
            </div>
        </div>
    </div>
</div>
<div class="section last-section">
    <div class="col-md-12 text-center">  <p class="text-center">In order to upload your corporate logo, after the registration, go to your profile and log in. There you can upload your corporate logo and change all the details.</p>
      <br>
        <p class="text-center" contenteditable="true">By Signing Up you accept our</p>
        <a href="<?= Url::to('uslovi-koristenja'); ?>"> Terms of Use</a>
    </div>
</div>

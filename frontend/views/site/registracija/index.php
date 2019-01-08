<?php
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use dosamigos\ckeditor\CKEditor;
use yii\helpers\ArrayHelper;

use yii\captcha\Captcha;

$this->title = 'Registration';
?>

<div class="sign-container" id="registration-page">
    <div class="reg">
        
        <div class="sign-header">
            <h2>Registration</h2>
        </div>
        
        <div class="reg-controls">
            <?php $form = ActiveForm::begin(['id' => 'register-form', 'action' => ['site/registracija', ], 'fieldConfig' => ['template' => '{label}{input}']]); ?>

            <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>"/>
            
            <div class="column">
                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center form-input">
                        <?= $form->field($model, 'email')->textInput()->label('Email') ?>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center form-input">
                        <?= $form->field($model, 'first_name')->textInput()->label('First name') ?>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center form-input">
                        <?= $form->field($model, 'last_name')->textInput()->label('Last name') ?>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center form-input">
                        <?= $form->field($model, 'phone')->textInput()->label('Phone') ?>
                    </div>
                </div>

            </div>

            <div class="sec-column">
                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center form-input">
                        <?= $form->field($model, 'company_name')->textInput(['placeholder' => 'Must be a legally registered company'])->label('Company Name') ?>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center form-input">
                        <?= $form->field($model, 'location')->dropDownList(ArrayHelper::getColumn($model->countryArray, 'name'),['placeholder' => 'Select location'])->label('Location') ?>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center form-input">
                        <?= $form->field($model, 'address')->textInput(['placeholder' => ''])->label('Your wallet address from which you are going to pay with our tokens on our marketplace') ?>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center form-input">
                        <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Please enter your password', 'maxlength' => 20])->label('Password') ?>
                        <div class="password-checker">
                            <div class="pc__strenght">
                                <div class="pcs__text">Strength</div>
                                <div class="pcs__flags">
                                    <span class="pcsf__flag"></span>
                                    <span class="pcsf__flag"></span>
                                    <span class="pcsf__flag"></span>
                                </div>
                                <div class="pcs__strenght-text">Weak</div>
                            </div>
                            <div class="pc__checker">
                                <div class="pcc__char-count">
                                    <div class="pcc__icon"></div>
                                    <div class="pcc__text">6 to 20 characters</div>
                                </div>
                                <div class="pcc__symbol">
                                    <div class="pcc__icon"></div>
                                    <div class="pcc__text">Only consist of letters, numbers and symbols</div>
                                </div>
                                <div class="pcc__following-symbol">
                                    <div class="pcc__icon"></div>
                                    <div class="pcc__text">Contains at least two of the following: letters, numbers and symbols</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center form-input">
                        <?= $form->field($model, 'confirm_password')->passwordInput(['placeholder' => 'Please retype your password'])->label('Confirm Password') ?>
                    </div>
                </div>
            </div>


            <div>
                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center form-input">
                        <?= $form->field($model, 'userType')->radioList([2 => 'Supplier', 3 =>'Buyer', 4 => 'Both'])->label('I am a: ') ?>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center form-input">
                        <?= $form->field($model, 'captcha')->widget(Captcha::className())->label('Enter text from image') ?>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12 text-center form-input">
                        <button type="submit" class="active btn btn-block btn-primary">Confirm</button>
                    </div>
                </div>
            </div>
            <div class="last-section">
                <div class="col-md-12 text-center">
                    <br><p class="text-center">
                        In order to upload your corporate logo, provide corporate verification and list your product/s, please login into your account after successfull registration. </p>
                    <p class="text-center" contenteditable="true">
                      
                        &nbsp;By pressing the CONFIRM button you agree to our Listing Policy, Terms Of Use and Privacy Policy. &nbsp;</p>
                    
                </div>
            </div>
            <?php ActiveForm::end(); ?>
            </div>
        </div>

        
    </div>
<?php if($model->errors && isset($model->errors['email'])): ?>
    <div class="registration-failed">

        <div class="register-failed-msg-wrapper">
            <div class="register-failed-close">X</div>
            <p>A user with this email address is already registered - please use another email address to create your account</p>
            <br>
        </div>
    </div>
<?php endif; ?>

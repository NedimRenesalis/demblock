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


            <div class="last-column">
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
                        <input type="submit" class="active btn btn-block btn-info" value="Confirm"/>
                    </div>
                </div>
            </div>
            <div class="last-section">
                <div class="col-md-12 text-center">
                    <br><p class="text-center">
                        Da biste izvršili upload loga firme, nakon ovde završene registracije, prijavite se na početnoj www.zaposljavanje.ba stranici na Vaš profil. </p>
                    <p class="text-center" contenteditable="true">Popunjavanjem formulara i kreiranjem novog korisničko računa,
                        kao
                        &nbsp;i klikom na “Registruj se” prihvatate da se slažete sa:&nbsp;</p>
                    <a href="<?= Url::to('uslovi-koristenja'); ?>">Uslovima korištenja, Privatnosti, kao i Copyright-a</a>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
            </div>
        </div>

        
    </div>
</div>

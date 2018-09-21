<?php
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

use dosamigos\ckeditor\CKEditor;
use yii\captcha\Captcha;

$this->title = 'Zapošljavanje';
?>
<div class="section" id="registration-page">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center">Registrierung Arbeitgeber</h3>
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
                        <?= $form->field($model, 'full_name')->textInput()->label('Kontaktperson') ?>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'email')->textInput()->label('Email') ?>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'company_name')->textInput()->label('Firmenname') ?>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'address')->textInput()->label('Firmenanschrift') ?>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'zip_code')->textInput()->label('Postleitzahl') ?>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'phone')->textInput()->label('Telefonnummer') ?>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'pdv')->textInput()->label('USt.- Nummer') ?>
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
                                'language'=>'de'
                            ]

                        ])->label('Firmenbeschreibung'); ?>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'password')->passwordInput()->label('Passwort') ?>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'confirm_password')->passwordInput()->label('Passwort wiederholen') ?>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'captcha')->widget(Captcha::className())->label('Tragen Sie hier den Text aus dem Bild ein') ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12 col-sm-offset- text-center">
                        <input type="submit" class="active btn btn-block btn-info" value="Registrieren"/>
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
    <div class="col-md-12 text-center">
      <p class="text-center">Um Ihr Firmenlogo hochzuladen, schliessen Sie bitte diese Registrierung ab und gehen Sie dann über die Hauptseite www.zaposljavanje.ba zur Anmeldung.
<br>Dort melden Sie sich in Ihrem Profil an, wo Sie das Firmenlogo speichern und alle anderen Daten jederzeit ändern können.</p>
      <br>
        <p class="text-center">Mit der Registrierung und jeder Anmeldung bestätigen Sie, dass Sie unsere </p>
        <a href="<?= Url::to('uslovi-koristenja'); ?>">AGB akzeptieren</a>
    </div>
</div>

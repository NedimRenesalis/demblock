<?php
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use dosamigos\ckeditor\CKEditor;

use yii\captcha\Captcha;

$this->title = 'demblock';
?>

<div class="section" id="registration-page">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center">Registracija poslodavac</h3>
                <br>
                <br><center>

                <b>NAPOMENA: Ova registracija je samo za
                <br>pravna lica registrovana u BiH.</b>
                <br>
                <br>Pravna lica iz inostranstva se mogu samo
                <br>registrovati na engleskoj ili
                <br>njemačkoj verziji ove aplikacije.</center>
                <br>
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
                        <?= $form->field($model, 'full_name')->textInput()->label('Kontakt osoba') ?>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'email')->textInput()->label('Email adresa') ?>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'company_name')->textInput()->label('Naziv firme') ?>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'address')->textInput()->label('Adresa') ?>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'zip_code')->textInput()->label('Poštanski broj') ?>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'phone')->textInput()->label('Kontakt telefon') ?>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'pdv')->textInput()->label('PDV broj') ?>
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
                                'language'=>'hr'
                            ]

                        ])->label('Opis kompanije'); ?>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'password')->passwordInput()->label('Lozinka') ?>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'confirm_password')->passwordInput()->label('Ponovite lozinku') ?>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'captcha')->widget(Captcha::className())->label('Upišite tekst sa slike ') ?>
                    </div>
                </div>
               <!-- <form role="form">
                    <div class="form-group">
                        <br>
                        <label class="control-label" for="exampleInputEmail1">Kontakt osoba</label>
                        <input class="form-control" id="exampleInputEmail1" placeholder="Ime i prezime" type="text">
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="exampleInputPassword1">E-mail adresa</label>
                        <input class="form-control" id="exampleInputPassword1" placeholder="E-mail adresa" type="email">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Kreirajte lozinku</label>
                        <input class="form-control" type="text">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Potvrdite lozinku</label>
                        <input class="form-control" type="text">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Naziv firme</label>
                        <input class="form-control" type="text">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Država i grad</label>
                        <textarea class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Broj telefona</label>
                        <input class="form-control" type="text">
                    </div>
                    <div class="form-group">
                        <label class="control-label">PDV broj</label>
                        <input class="form-control" type="text">
                    </div>
                </form>-->
                <div class="form-group">
                    <div class="col-sm-12 col-sm-offset- text-center">
                        <input type="submit" class="active btn btn-block btn-info" value="Registracija"/>
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
      <br><p class="text-center">
        Da biste izvršili upload loga firme, nakon ovde završene registracije, prijavite se na početnoj www.zaposljavanje.ba stranici na Vaš profil. </p>
        <p class="text-center" contenteditable="true">Popunjavanjem formulara i kreiranjem novog korisničko računa,
            kao
            &nbsp;i klikom na “Registruj se” prihvatate da se slažete sa:&nbsp;</p>
        <a href="<?= Url::to('uslovi-koristenja'); ?>">TERMS OF USE</a>
    </div>
</div>

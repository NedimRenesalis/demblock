<?php
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Zapošljavanje';

$genders = ['Muško' => ' Muško', 'Žensko' => 'Žensko'];
$jobs = [
    "Ostala zanimanja" => "Ostala zanimanja",
    "Savjetovanje - Consulting usluge" => "Savjetovanje - Consulting usluge",
    "Informatika - Hardware" => "Informatika - Hardware",
    "Informatika - Software" => "Informatika - Software",
    "Proizvodnja" => "Proizvodnja",
    "Zanati" => "Zanati",
    "Management" => "Management",
    "Poduzetništvo" => "Poduzetništvo",
    "Grafika i dizajn" => "Grafika i dizajn",
    "Ljudski resursi - Human Resources - HR" => "Ljudski resursi - Human Resources - HR",
    "Knjigovodstvo – Revizija - Controlling" => "Knjigovodstvo – Revizija - Controlling",
    "Administrativne Usluge" => "Administrativne Usluge",
    "Prodaja - Komercijala" => "Prodaja - Komercijala",
    "Nabavka - Supply Chain Management" => "Nabavka - Supply Chain Management",
    "Transport - Logistika" => "Transport - Logistika",
    "Sekretarski poslovi - Asistencija" => "Sekretarski poslovi - Asistencija",
    "Obrazovanje" => "Obrazovanje",
    "Arhitektonske Usluge" => "Arhitektonske Usluge",
    "Finansije i Bankarstvo" => "Finansije i Bankarstvo",
    "Osiguranja" => "Osiguranja",
    "Farmacija i Biotehnologija" => "Farmacija i Biotehnologija",
    "Državna Služba i Uprava",
    "Ekonomija" => "Ekonomija",
    "Elektrotehnika - Mašinstvo" => "Elektrotehnika - Mašinstvo",
    "Energetika" => "Energetika",
    "Građevinarstvo" => "Građevinarstvo",
    "Ljepota i Zdravlje" => "Ljepota i Zdravlje",
    "Odnosi sa Javnošću - PR" => "Odnosi sa Javnošću - PR",
    "Mediji" => "Mediji",
    "Nauka - Istraživački Radovi" => "Nauka - Istraživački Radovi",
    "Nekretnine" => "Nekretnine",
    "Obrazovanje" => "Obrazovanje",
    "Oglasi ZZZRS" => "Oglasi ZZZRS",
    "Zaštitarske Usluge" => "Zaštitarske Usluge",
    "Rudarstvo" => "Rudarstvo",
    "Industrija" => "Industrija",
    "Trgovina" => "Trgovina",
    "Zastupanje" => "Zastupanje",
    "Socijalne Usluge" => "Socijalne Usluge",
    "NVO - Nevladine Organizacije" => "NVO - Nevladine Organizacije",
    "Telekomunikacije" => "Telekomunikacije",
    "Turizam - Ugostiteljstvo - Hotelijerstvo" => "Turizam - Ugostiteljstvo - Hotelijerstvo",
    "Veterina" => "Veterina",
    "Zabava" => "Zabava",
    "Pravne Usluge" => "Pravne Usluge"
];

$locations = [
    "Kanton Sarajevo" => "Kanton Sarajevo",
    "Ze-Do Kanton" => "Ze-Do Kanton",
    "Unsko-Sanski Kanton" => "Unsko-Sanski Kanton",
    "Srednjobosanski Kanton" => "Srednjobosanski Kanton",
    "Posavski Kanton" => "Posavski Kanton",
    "Hercegovačko-Neretvanski Kanton" => "Hercegovačko-Neretvanski Kanton",
    "Tuzlanski Kanton" => "Tuzlanski Kanton",
    "Zapadnohercegovački Kanton" => "Zapadnohercegovački Kanton",
    "Kanton Br. 10" => "Kanton Br. 10",
    "Bosansko-Podrinjski Kanton" => "Bosansko-Podrinjski Kanton",
    "Republika Srpska" => "Republika Srpska",
    "Makedonija" => "Makedonija",
    "Republika Srbija" => "Republika Srbija",
    "Crna Gora" => "Crna Gora",
    "Kosovo" => "Kosovo",
    "Zemlje Evropske Unije" => "Zemlje Evropske Unije",
    "SAD" => "SAD",
    "Kanada" => "Kanada",
    "Australija" => "Australija",
    "Zemlje golfskog zaljeva" => "Zemlje golfskog zaljeva",
    "Azija" => "Azija",
    "Afrika" => "Afrika",
    "Južna Amerika" => "Južna Amerika",
    "Inernacionalne vode - poslovi na kruzerima" => "Inernacionalne vode - poslovi na kruzerima",
]
?>

<div class="section" id="registration-page">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center">Profil posloprimac</h3>
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
                          CV je uploadovan.
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12 col-sm-offset- text-center">
                            <a href="<?= Url::to('download-cv'); ?>" class="active btn btn-block btn-success">
                                Download CV<a/>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="form-group">
                        <div class="col-sm-12 text-center missing-cv">
                            CV nije uploadovan.
                        </div>
                    </div>
                <?php endif; ?>
                <br>

                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'first_name')->textInput()->label('Ime') ?>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'last_name')->textInput()->label('Prezime') ?>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'email')->textInput(['disabled' => true])->label('Email adresa') ?>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'year_of_birth')->textInput()->label('Godina rođenja') ?>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'gender')->dropDownList($genders, ['prompt' => 'Odaberite pol'])->label('Pol') ?>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'zip_code')->textInput()->label('Poštanski broj') ?>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'job')->dropDownList($jobs, ['prompt' => 'Odaberite'])->label('Kategorije u kojima tražite posao') ?>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'location')->dropDownList($locations, ['prompt' => 'Odaberite'])->label('Prebivalište ili lokacija na kojoj tražite posao') ?>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'education_level')->textInput()->label('Navedite Vašu struku') ?>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'career_level')->textInput()->label('Navedite Vaše zanimanje') ?>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'additional_experience')->textarea()->label('Navedite eventualne dodatne kvalifikacije') ?>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'phone')->textInput()->label('Kontakt telefon') ?>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12 col-sm-offset- text-center">
                        <input type="submit" class="active btn btn-block btn-info" value="Spasi izmjene"/>

                    </div>
                </div>
                <?php ActiveForm::end(); ?>

                <div class="form-group">
                    <div class="col-sm-12 col-sm-offset- text-center">
                        <a href="<?= Url::to('upload-cv'); ?>" class="active btn btn-block btn-success">
                            Upload novog CV ili izmjena postojoćeg<a/>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <img src="<?= Url::to('@web/css/images/registration-employee-right.jpg'); ?>" class="img-responsive">
            </div>
        </div>
    </div>
</div>
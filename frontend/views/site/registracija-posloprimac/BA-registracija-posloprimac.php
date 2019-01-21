<?php
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\captcha\Captcha;

$this->title = 'demblock';
$genders = ['Muško' => ' Muško', 'Žensko' => 'Žensko'];
$jobs = [
    "Agriculture" => "Agriculture",
    "Food & Beverage" => "Food & Beverage",
    "Apparel" => "Apparel",
    "Textile & Leather Products" => "Textile & Leather Products",
    "Fashion Accessories" => "Fashion Accessories",
    "Timepieces, Jewelry, Eyewear" => "Timepieces, Jewelry, Eyewear",
    "Automobiles" => "Automobiles",
    "Motorcycles" => "Motorcycles",
    "Transportation" => "Transportation",
    "Luggage" => "Luggage",
    "Bags" => "Bags",
    "Cases" => "Cases",
    "Shoes & Accessories" => "Shoes & Accessories",
    "Computer Software & Hardware" => "Computer Software & Hardware",
    "Home Appliance" => "Home Appliance",
    "Consumer Electronic" => "Consumer Electronic",
    "Security & Protection" => "Security & Protection",
    "Electrical Equipment & Supplies" => "Electrical Equipment & Supplies",
    "Telecommunication" => "Telecommunication",
    "Sports & Entertainment" => "Sports & Entertainment",
    "Gifts & Crafts" => "Gifts & Crafts",
    "Toys & Hobbies" => "Toys & Hobbies",
    "Health & Medical" => "Health & Medical",
    "Beauty & Personal Care" => "Beauty & Personal Care",
    "Construction & Real Estate" => "Construction & Real Estate",
    "Home & Garden" => "Home & Garden",
    "Lights & Lighting" => "Lights & Lighting",
    "Furniture" => "Furniture",
    "Machinery" => "Machinery",
    "Industrial Parts & Fabrication Services" => "Industrial Parts & Fabrication Services",
    "Tools" => "Tools",
    "Hardware" => "Hardware",
    "Measurement & Analysis Instruments" => "Measurement & Analysis Instruments",
    "Minerals & Metallurgy" => "Minerals & Metallurgy",
    "Chemicals" => "Chemicals",
    "Rubber & Plastics" => "Rubber & Plastics",
    "Energy" => "Energy",
    "Environment" => "Environment",
    "Packaging & Printing" => "Packaging & Printing",
    "Office & School Supplies" => "Office & School Supplies",
    "Service Equipment" => "Service Equipment",
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
                <h3 class="text-center">Registracija posloprimac</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <img src="<?= Url::to('@web/css/images/registration-employee-left.jpg'); ?>" class="img-responsive">
            </div>
            <div class="col-md-4">
                <?php $form = ActiveForm::begin(['id' => 'register-employee-form', 'action' => ['site/registracija-posloprimac'], 'fieldConfig' => ['template' => '{label}{input}']]); ?>

                <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>"/>

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
                        <?= $form->field($model, 'email')->textInput()->label('Email adresa') ?>
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


                <!--


                <div class="form-group">
                    <div class="col-sm-12 text-center">
                        <label for="inputPrezime3" class="control-label">Prezime</label>
                    </div>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="inputPrezime3" placeholder="Prezime">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12 text-center">
                        <label for="inputEmail adresa3" class="control-label">Email adresa</label>
                    </div>
                    <div class="col-sm-12 text-center">
                        <input type="email" class="form-control" id="inputEmail adresa 3" placeholder="Unesite Email">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12 text-center">
                        <label for="inputGodina rodenja3" class="control-label">Godina rođenja</label>
                    </div>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="inputGodina rodenja3" placeholder="Unesite godinu">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12 text-center">
                        <label class="control-label">Pol</label>
                    </div>
                    <div class="col-sm-12">
                        <select class="form-control">
                            <option>Odaberite pol</option>
                            <option></option>
                            <option>Žensko</option>
                            <option>Muško</option>
                            <option></option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12 text-center">
                        <label class="control-label">Prebivalište ili lokacija na kojoj tražite posao</label>
                    </div>
                    <div class="col-sm-12 text-center">
                        <select class="form-control">
                            <option>Odaberite lokaciju</option>
                            <option>_____________________</option>
                            <option>Kanton Sarajevo</option>
                            <option>Ze-Do Kanton</option>
                            <option>Unsko-Sanski Kanton</option>
                            <option>Srednjobosanski Kanton</option>
                            <option>Posavski Kanton</option>
                            <option>Hercegovačko-Neretvanski Kanton</option>
                            <option>Tuzlanski Kanton</option>
                            <option>Zapadnohercegovački Kanton</option>
                            <option>Kanton Br. 10</option>
                            <option>Bosansko-Podrinjski Kanton</option>
                            <option>Republika Srpska</option>
                            <option>_____________________</option>
                            <option>Makedonija</option>
                            <option>Republika Srbija</option>
                            <option>Crna Gora</option>
                            <option>Kosovo</option>
                            <option>_____________________</option>
                            <option>Zemlje Evropske Unije</option>
                            <option></option>
                            <option>SAD</option>
                            <option></option>
                            <option>Kanada</option>
                            <option></option>
                            <option>Australija</option>
                            <option></option>
                            <option>Zemlje golfskog zaljeva</option>
                            <option></option>
                            <option>Azija - ostale zemlje</option>
                            <option></option>
                            <option>Afrika</option>
                            <option></option>
                            <option>Južna Amerika</option>
                            <option></option>
                            <option>Inernacionalne vode - poslovi na kruzerima</option>
                            <option>_____________________</option>
                            <option></option>
                            <option></option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12 text-center">
                        <label class="control-label">Kategorije u kojima tražite posao</label>
                    </div>
                    <div class="col-sm-12">
                        <select class="form-control">
                            <option>Izaberite kategoriju zaposlenja</option>
                            <option>_________________________________</option>
                            <option>Ostala zanimanja</option>
                            <option>_________________________________</option>
                            <option>Savjetovanje - Consulting usluge</option>
                            <option>Informatika - Hardware</option>
                            <option>Informatika - Software</option>
                            <option>Proizvodnja</option>
                            <option>Zanati</option>
                            <option>Management</option>
                            <option>Poduzetništvo</option>
                            <option>Grafika i dizajn</option>
                            <option>Ljudski resursi - Human Resources - HR</option>
                            <option>Knjigovodstvo – Revizija - Controlling</option>
                            <option>Administrativne Usluge</option>
                            <option>Prodaja - Komercijala</option>
                            <option>Nabavka - Supply Chain Management</option>
                            <option>Transport - Logistika</option>
                            <option>Sekretarski poslovi - Asistencija</option>
                            <option>Obrazovanje</option>
                            <option>Arhitektonske Usluge</option>
                            <option>Finansije i Bankarstvo</option>
                            <option>Osiguranja</option>
                            <option>Farmacija i Biotehnologija</option>
                            <option>Državna Služba i Uprava</option>
                            <option>Ekonomija</option>
                            <option>Elektrotehnika - Mašinstvo</option>
                            <option>Energetika</option>
                            <option>Građevinarstvo</option>
                            <option>Ljepota i Zdravlje</option>
                            <option>Odnosi sa Javnošću - PR</option>
                            <option>Mediji</option>
                            <option>Nauka - Istraživački Radovi</option>
                            <option>Nekretnine</option>
                            <option>Obrazovanje</option>
                            <option>Oglasi ZZZRS</option>
                            <option>Zaštitarske Usluge</option>
                            <option>Rudarstvo</option>
                            <option>Industrija</option>
                            <option>Trgovina</option>
                            <option>Zastupanje</option>
                            <option>Socijalne Usluge</option>
                            <option>NVO - Nevladine Organizacije</option>
                            <option>Telekomunikacije</option>
                            <option>Turizam - Ugostiteljstvo - Hotelijerstvo</option>
                            <option>Veterina</option>
                            <option>Zabava</option>
                            <option>Pravne Usluge</option>
                            <option>Zabava</option>
                            <option></option>
                            <option></option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12 text-center">
                        <label class="control-label">Navedite Vašu struku</label>
                    </div>
                    <div class="col-sm-12 text-center">
                        <input type="text" class="form-control" placeholder="naprimjer: zanat, SSS, VSS">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12 text-center">
                        <label class="control-label">Navedite eventualne dodatne kvalifikacije</label>
                    </div>
                    <div class="col-sm-12 text-center">
                        <input type="text" class="form-control" placeholder="naprimjer: strani jezici, kursevi">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12 text-center">
                        <label class="control-label">Kontakt telefon</label>
                    </div>
                    <div class="col-sm-12 text-center">
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12 text-center">
                        <label class="control-label">Kreirajte lozinku</label>
                    </div>
                    <div class="col-sm-12 text-center">
                        <input type="password" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12 text-center">
                        <label class="control-label">Ponovite lozinku</label>
                    </div>
                    <div class="col-sm-12 text-center">
                        <input type="password" class="form-control">
                    </div>
                </div>-->
                <div class="form-group">
                    <div class="col-sm-12 col-sm-offset- text-center">
                        <input type="submit" class="active btn btn-block btn-info" value="Registracija"/>
                        <!-- <br>
                         <button type="submit" class="active btn btn-block btn-primary">Facebook prijava</button>
                         <br>
                         <button type="submit" class="active btn btn-block btn-info">LinkedIn prijava</button>
                         <br>
                         <button type="submit" class="active btn btn-block btn-primary">XING prijava</button>
                         <br>-->
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
            <div class="col-md-4">
                <img src="<?= Url::to('@web/css/images/registration-employee-right.jpg'); ?>" class="img-responsive">
            </div>
        </div>
    </div>
</div>
<div class="section last-section">
    <div class="col-md-12 text-center">
      <p class="text-center">Da biste izvršili upload Vašeg CV-a, nakon ovde završene registracije, prijavite se na početnoj www.zaposljavanje.ba stranici na Vaš profil. </p>
<br>
        <p class="text-center" contenteditable="true">Popunjavanjem formulara i kreiranjem novog korisničko računa, kao
            &nbsp;i klikom na “Registruj se” prihvatate da se slažete sa:&nbsp;</p>
        <a href="<?= Url::to('uslovi-koristenja'); ?>">Uslovima korištenja, Privatnosti, kao i Copyright-a</a>
    </div>
</div>

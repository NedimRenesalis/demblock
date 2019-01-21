<?php
use yii\helpers\Url;
use yii\widgets\ActiveForm;

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
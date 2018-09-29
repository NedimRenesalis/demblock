<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Zapošljavanje';

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
?>

<div class="hidden-sm hidden-xs section section-success">
    <div class="container">
        <div class="row">
            <div class="col-md-9 text-justify">
                <img class="img-responsive" src="<?= Url::to('@web/css/images/hero.jpg') ?>">
            </div>
            <div class="col-md-3">
                <div class="section text-justify">
                    <div class="row">
                        <br>
                        <br>
                        <div class="search-form ">
                            <?php $form = ActiveForm::begin(['method' => 'get']); ?>

                            <div class="search-form-col">
                                <?= $form->field($searchModel, 'location')->textInput(['maxlength' => true, 'placeholder' => "Country of sourcing"])->label('') ?>
                            </div>

                            <br>
                            <div class="search-form-col">
                                <?= $form->field($searchModel, 'category')->dropDownList($jobs, ['prompt' => 'Select category', 'label' => null])->label("") ?>
                            </div>
                            <br>
                            <div class="form-group search-button search-form-col">
                                <?= Html::submitButton('Search', ['class' => 'active btn btn-block btn-info btn-lg']) ?>
                            </div>

                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-header">
    <div class="container">
        <?php
            echo $this->render('../banner/_banner', ['adspace' => 'location_top']);
        ?>
    </div>
</div>

<?php $form = ActiveForm::begin(['method' => 'get']); ?>
<div class="hidden-lg hidden-md section section-success">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="search-form-col">
                    <?= $form->field($searchModel, 'category')->dropDownList($jobs, ['prompt' => 'Select category', 'label' => null])->label("") ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="hidden-lg hidden-md hidden-xs section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <div class="col-sm-12">
                        <?= $form->field($searchModel, 'location')->textInput(['maxlength' => true, 'placeholder' => "Country of sourcing"])->label('') ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="search-form-col">
                        <?= $form->field($searchModel, 'category')->dropDownList($jobs, ['prompt' => 'Select category', 'label' => null])->label("") ?>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12 col-sm-offset-0,9 text-center">
                            <?= Html::submitButton('Search', ['class' => 'active btn btn-info']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="hidden-lg hidden-md hidden-sm section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form class="form-horizontal" role="form">
                    <div class="col-sm-6">
                        <?= $form->field($searchModel, 'location')->textInput(['maxlength' => true, 'placeholder' => "Country of sourcing"])->label('') ?>
                    </div>
                    <div class="search-form-col">
                        <?= $form->field($searchModel, 'category')->dropDownList($jobs, ['prompt' => 'Select category', 'label' => null])->label("") ?>
                    </div>
                    <div class="col-sm-10 col-sm-offset-2 text-center">
                        <?= Html::submitButton('Search', ['class' => 'active btn btn-info']) ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="section">
    <div class="container index-button">
        <div class="row">
            <div class="col-md-12 text-center">
                <a class="active btn btn-primary hidden-xs" href="<?= Url::to('objava-oglasa'); ?>">Objava
                    oglasa</a>
                <a class="active btn btn-primary hidden-xs" href="<?= Url::to('cjenovnik-usluge'); ?>">Cijenovnik
                    i usluge</a>
                <a class="active btn btn-primary hidden-xs" href="<?= Url::to('kontakt-prodaja'); ?>">Kontakt
                    prodaja</a>
                <br>
                <br>
                <a class="active btn btn-block btn-primary" href="<?= Url::to('o-nama'); ?>">Ko smo mi</a>
                <br>
                <a class="active btn btn-block btn-primary" href="<?= Url::to('zasto-odabrati-nas'); ?>">Zašto
                    odabrati nas</a>
                <br>

            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 hidden-lg hidden-md hidden-sm text-center">

        <br>

        <p class="text-center">Preuzmite mobilnu aplikaciju</p>

        <br>

        <a href="https://itunes.apple.com/us/app/zaposljavanje/id1293977864?ls=1&mt=8"><i class="fa fa-apple"
                                                                                          style="font-size:36px"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

        <a href="https://play.google.com/store/apps/details?id=com.zaposljavanje&hl=en"><i class="fa fa-android"
                                                                                           style="font-size:36px"></i></a>

    </div>
</div>

<div class="hidden-lg hidden-md hidden-sm section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 hidden-lg hidden-md hidden-sm text-center">
                <a class="active btn btn-block btn-success" href="<?= Url::to('objava-oglasa'); ?>">Objava oglasa</a>
                <br>
                <br>
                <a class="active btn btn-success" href="<?= Url::to('cjenovnik-usluge'); ?>">Cijenovnik oglasa</a>
                <a class="active btn btn-success" href="<?= Url::to('kontakt-prodaja'); ?>">Kontakt prodaja</a>
            </div>
        </div>
    </div>
</div>


<?php if ($platinum || $midi): ?>
    <?php $counter = 0; ?>
    <div class="section premium">
        <?php foreach ($platinum as $p): ?>
            <?php $counter++; ?>
            <div class="premium-wrapper col-lg-2 col-sm-4 col-xs-6 col-xxs-12">
                <a target="_blank" href="<?= Url::to(['oglas', "id" => $p->id]); ?>">
                    <?php echo $this->render('_ba-sponzorisani-oglas', ['model' => $p]); ?>
                </a>
            </div>
            <?php if ($counter % 12 === 0): ?>
                <div class="col-lg-12">
                    <?php echo $this->render('_google_advert'); ?>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
        <?php foreach ($midi as $m): ?>
            <?php $counter++; ?>
            <div class="premium-wrapper col-lg-2 col-sm-4 col-xs-6 ">
                <a target="_blank" href="<?= Url::to(['oglas', "id" => $m->id]); ?>">
                    <?php echo $this->render('_ba-sponzorisani-oglas', ['model' => $m]); ?>
                </a>
            </div>
            <?php if ($counter % 12 === 0): ?>
                <div class="col-lg-12">
                    <?php echo $this->render('_google_advert'); ?>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>


<div class="hidden-lg hidden-md section section-success text-right">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <img src="<?= Url::to('@web/css/images/hero-mob.jpg') ?>" class="hidden-lg hidden-md img-responsive">
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>

<?php if (false && $sponsored): ?>
    <div class="section">
        <?= $sponsored->html; ?>
    </div>
<?php endif; ?>


<footer class="section section-success">
    <div class="container-footer">
        <div class="container">
            <?php
                echo $this->render('../banner/_banner', ['adspace' => 'location_bottom']);
            ?>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <p class="text-center"></p>
                <h3 class="text-center">zaposljavanje.ba - oglasi za posao</h3>
                <p></p>
                <p></p>
                <p class="text-center">
                    <br>Renesalis d.o.o.
                    <br>Igmanska bb - 71320 Vogošća - BiH
                    <br>
                    <a href="mailto:#">oglasi@zaposljavanje.ba</a>
                    <br>Tel: 062-332-325</p>
            </div>
            <div class="col-sm-6">
                <p class="text-info text-right">
                    <br>
                    <br>
                </p>
                <div class="row">
                    <div class="col-md-12 hidden-lg hidden-md hidden-sm text-center">
                        <a href="https://www.instagram.com/zaposljavanje.ba/"><i
                                    class="fa fa-2x fa-fw fa-instagram text-inverse"></i></a>
                        <a href="https://www.linkedin.com/company/18282027/"><i
                                    class="fa fa-2x fa-fw fa-linkedin text-inverse"></i></a>
                        <a href="https://www.facebook.com/zaposljavanje.ba/"><i
                                    class="fa fa-2x fa-facebook fa-fw text-inverse"></i></a>
                        <br>
                        <br>
                        <p class="text-center">Preuzmite mobilnu aplikaciju</p>

                        <br><a href="https://itunes.apple.com/us/app/zaposljavanje/id1293977864?ls=1&mt=8"><i
                                    class="fa fa-apple" style="font-size:36px"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a
                                href="https://play.google.com/store/apps/details?id=com.zaposljavanje&hl=en"><i
                                    class="fa fa-android" style="font-size:36px"></i></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 hidden-xs text-right">
                        <a href="https://www.instagram.com/zaposljavanje.ba/"><i
                                    class="fa fa-2x fa-fw fa-instagram text-inverse"></i></a>
                        <a href="https://www.linkedin.com/company/18282027/"><i
                                    class="fa fa-2x fa-fw fa-linkedin text-inverse"></i></a>
                        <a href="https://www.facebook.com/zaposljavanje.ba/"><i
                                    class="fa fa-2x fa-facebook fa-fw text-inverse"></i></a>
                        <br>
                        <br>
                        <p class="text-right">Preuzmite mobilnu aplikaciju za mobilne telefone i tablete</p>
                        <br><a href="https://itunes.apple.com/us/app/zaposljavanje/id1293977864?ls=1&mt=8"><i
                                    class="fa fa-apple" style="font-size:36px"></i></a>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a
                                href="https://play.google.com/store/apps/details?id=com.zaposljavanje&hl=en"><i
                                    class="fa fa-android" style="font-size:36px"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a class="active btn btn-block btn-primary" href="<?= Url::to('uslovi-koristenja'); ?>">Copyright
                    - Privatnost - Uslovi korištenja</a>
            </div>
        </div>
    </div>
</div>
<?php if (Yii::$app->user->isGuest): ?>
    <div class="hidden-lg hidden-md section section-success">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center">
                    <a class="active btn btn-primary" id="DE-mob">Deutsch </a>
                    <a class="active btn btn-primary" id="EN-mob">English</a>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if ($registered): ?>
    <div class="just-registered-wrapper">
        <div class="just-registered">
            <div class="close-img">
                <img class="image-responsive" src="<?= Url::to('@web/css/images/close.png') ?>">
            </div>
            Hvala na registraciji
        </div>
    </div>
<?php endif; ?>

<script>
    $(document).ready(function () {
        $("body").on("click", function () {
            $(".just-registered-wrapper").hide();
        })
    })
</script>

<style>
    .navbar#top {
        background-color: #e6e6fa;
    }

    .navbar-right form {
        background-color: #e6e6fa;
    }

    .navbar-inverse .navbar-nav > li > a {
        color: #000000 !important;
        background-color: #e6e6fa !important;
    }

</style>

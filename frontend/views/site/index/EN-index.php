<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Zapošljavanje';
?>


<div class="hidden-sm hidden-xs section section-success">
    <div class="container">
        <div class="row">
            <div class="col-md-9 text-justify">
                <img src="<?= Url::to('@web/css/images/hero3.jpg') ?>" class="img-responsive">
            </div>
            <div class="col-md-3">
                <div class="section text-justify">
                    <div class="row">
                        <br>
                        <br>
                        <div class="search-form ">
                            <?php $form = ActiveForm::begin(['method' => 'post']); ?>
                            <div class="search-form-col">
                                <?= $form->field($searchModel, 'location')->textInput(['maxlength' => true, 'placeholder' => "City or Country"])->label('') ?>
                            </div>
                            <br>
                            <div class="search-form-col">
                                <?= $form->field($searchModel, 'position')->textInput(['maxlength' => true, 'placeholder' => "Job title, skill or company"])->label('') ?>
                            </div>
                            <br>
                            <div class="search-form-col">
                                <?= $form->field($searchModel, 'category')->textInput(['placeholder' => 'Sector', 'maxlength' => true])->label("") ?>
                            </div>
                            <br>
                            <div class="form-group search-button search-form-col">
                                <?= Html::submitButton('Find job', ['class' => 'active btn btn-info']) ?>
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

<?php $form = ActiveForm::begin(['method' => 'post']); ?>

<div class="hidden-lg hidden-md section section-success">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="col-sm-12">
                    <div class="search-form-col">
                        <?= $form->field($searchModel, 'category')->textInput(['placeholder' => 'Job title', 'maxlength' => true])->label("") ?>
                    </div>
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
                        <?= $form->field($searchModel, 'location')->textInput(['maxlength' => true, 'placeholder' => "City or Country"])->label('') ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <?= $form->field($searchModel, 'position')->textInput(['maxlength' => true, 'placeholder' => "Job title"])->label('') ?>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12 col-sm-offset-0,9 text-center">
                            <?= Html::submitButton('Find job', ['class' => 'active btn btn-info']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="hidden-lg hidden-md hidden-sm section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <div class="col-sm-12">
                        <?= $form->field($searchModel, 'location')->textInput(['maxlength' => true, 'placeholder' => "City or Country"])->label('') ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <?= $form->field($searchModel, 'position')->textInput(['maxlength' => true, 'placeholder' => "Job title"])->label('') ?>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12 col-sm-offset-0,9 text-center">
                            <?= Html::submitButton('Find job', ['class' => 'active btn btn-info']) ?>
                        </div>
                    </div>
                </div>
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

<?php if ($platinum || $midi): ?>
    <?php $counter = 0; ?>
    <div class="section premium">
        <?php foreach ($platinum as $p): ?>
            <?php $counter++; ?>
            <div class="premium-wrapper col-lg-2 col-sm-4 col-xs-6 col-xxs-12">
                <a target="_blank" href="<?= Url::to(['oglas', "id" => $p->id]); ?>">
                    <?php echo $this->render('_en-sponzorisani-oglas', ['model' => $p]); ?>
                </a>
            </div>
            <?php if ($counter % 6 === 0): ?>
                <div class="col-lg-12">
                    <?php echo $this->render('_google_advert'); ?>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
        <?php foreach ($midi as $m): ?>
            <?php $counter++; ?>
            <div class="premium-wrapper col-lg-2 col-sm-4 col-xs-6 ">
                <a target="_blank" href="<?= Url::to(['oglas', "id" => $m->id]); ?>">
                    <?php echo $this->render('_en-sponzorisani-oglas', ['model' => $m]); ?>
                </a>
            </div>
            <?php if ($counter % 6 === 0): ?>
                <div class="col-lg-12">
                    <?php echo $this->render('_google_advert'); ?>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<center>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- 4 -->
<ins class="adsbygoogle"
     style="display:inline-block;width:300px;height:250px"
     data-ad-client="ca-pub-5242454575053212"
     data-ad-slot="3048289308"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</center>

<div class="hidden-lg hidden-md section section-success">
    <div class="container">
        <div class="row">
            <div class="col-md-12 hidden-lg hidden-md">
                <img src="<?= Url::to('@web/css/images/hero-mob3.jpg') ?>" class="hidden-lg hidden-md img-responsive">
            </div>
        </div>
    </div>
</div>
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <a class="active btn btn-primary hidden-xs" href="<?= Url::to('objava-oglasa'); ?>">Post a Job</a>
                <a class="active btn btn-primary hidden-xs" href="<?= Url::to('cjenovnik-usluge'); ?>">Products and
                    Pricing</a>
                <a class="active btn btn-primary hidden-xs" href="<?= Url::to('kontakt-prodaja'); ?>">Contact Sales</a>
                <a class="active btn btn-primary" href="<?= Url::to('o-nama'); ?>">About us</a>
                <a class="active btn btn-primary" href="<?= Url::to('zasto-odabrati-nas'); ?>">Why advertise with us</a>
            </div>
        </div>
    </div>
</div>
<div class="hidden-lg hidden-md hidden-sm section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <a class="active btn btn-success" href="<?= Url::to('objava-oglasa'); ?>">Post a Job</a>
                <a class="active btn btn-success" href="<?= Url::to('cjenovnik-usluge'); ?>">Products &amp; Pricing</a>
                <br>
                <br>
                <a class="active btn btn-success" href="<?= Url::to('kontakt-prodaja'); ?>">Contact Sales</a>
            </div>
        </div>
    </div>
</div>
<footer class="section section-success">
    <!-- Subscribe -->
    <div class="subscribe">
        <section class="main-search subscribe-footer ">
            <div class="container">
                <div class="row">
                    <div class="col-md-offset-2 col-md-9">
                        <?php $form = ActiveForm::begin([
                            'method' => 'post',
                            'fieldConfig' => ['options' => ['class' => 'no-margin form-group']],
                            'action' => ['subscribe'],
                            'options' => [
                                'class' => 'search-form',
                            ],
                        ]);?>

                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                <?=$form
                                ->field($subscribeModel, 'email', [
                                    'template' => "{label}\n<i class='fa fa-envelope-o subscribe-icon' aria-hidden='true'></i>\n{input}\n{hint}\n{error}",
                                ])
                                ->textInput([
                                    'placeholder' => \Yii::t('app', 'Email Address'),
                                    'class' => 'form-control subscribe-input',
                                ])
                                ->label(false)?>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group no-padding no-margin">
                                    <?=Html::submitButton(\Yii::t('app', 'Subscribe'), ['class' => 'btn btn-block btn-info'])?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php ActiveForm::end()?>
            </div>
        </section>
    </div>
    <!-- /Subscribe --> 
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
                <h3 class="text-center">zaposljavanje.ba - Job Search for Central Eastern Europe</h3>
                <p></p>
                <p></p>
                <p class="text-center">Renesalis d.o.o.
                    <br>Igmanska bb - 71320 Vogošća
                    <br>Bosnia and Hercegovina
                    <br>
                    <a href="mailto:#">oglasi@zaposljavanje.ba</a>
                    <br>Tel: 00387-62-332-325</p>
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
                        <a href="https://www.linkedin.com/company/18282027/"><i class="fa fa-2x fa-fw fa-linkedin text-inverse"></i></a>
                        <a href="https://www.facebook.com/zaposljavanje.ba/"><i class="fa fa-2x fa-facebook fa-fw text-inverse"></i></a>
<br>
<br><a href="https://itunes.apple.com/us/app/zaposljavanje/id1293977864?ls=1&mt=8"><i class="fa fa-apple" style="font-size:36px"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="https://play.google.com/store/apps/details?id=com.zaposljavanje&hl=en"><i class="fa fa-android" style="font-size:36px"></i></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 hidden-xs text-right">
                        <a href="https://www.instagram.com/zaposljavanje.ba/"><i
                                    class="fa fa-2x fa-fw fa-instagram text-inverse"></i></a>
                        <a href="https://www.linkedin.com/company/18282027/"><i class="fa fa-2x fa-fw fa-linkedin text-inverse"></i></a>
                        <a href="https://www.facebook.com/zaposljavanje.ba/"><i class="fa fa-2x fa-facebook fa-fw text-inverse"></i></a>
                        <br>
                        <br><a href="https://itunes.apple.com/us/app/zaposljavanje/id1293977864?ls=1&mt=8"><i class="fa fa-apple" style="font-size:36px"></i></a>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="https://play.google.com/store/apps/details?id=com.zaposljavanje&hl=en"><i class="fa fa-android" style="font-size:36px"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="hidden-xs section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <a class="active btn btn-primary" href="<?= Url::to('privatnost'); ?>">Privacy Policy and Contact</a>
                <a class="active btn btn-primary" href="<?= Url::to('uslovi-koristenja'); ?>">Terms of Use</a>
            </div>
        </div>
    </div>
</div>
<div class="hidden-lg hidden-md hidden-sm section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <a class="active btn btn-primary" href="<?= Url::to('privatnost'); ?>">Privacy Policy</a>
                <br>
                <br>
                <a class="active btn btn-primary" href="<?= Url::to('uslovi-koristenja'); ?>">Terms of Use</a>
                <br>
                <br>
            </div>
        </div>
    </div>
</div>
<?php if (Yii::$app->user->isGuest):?>
<div class="hidden-lg hidden-md section section-success">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <a class="active btn btn-primary" id="BA-mob">Bosanski </a>
                <a class="active btn btn-primary" id="DE-mob">Deutsch</a>
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
            Thank you for signing up
        </div>
    </div>
<?php endif; ?>

<script>
    $(document).ready(function () {
        $("body").on("click",function(){
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
</style>

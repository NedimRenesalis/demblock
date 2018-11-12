<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use frontend\models\Categories;


$this->title = 'Zapošljavanje';
$categories = Categories::find()->where(["ParentId" => null])->orderBy(['Name' => SORT_ASC])->all();
$jobs = [];
foreach ($categories as $category) {
    $jobs[$category->Name] = $category->Name;
}

$subCategoriesSelected = [];
if($searchModel && $searchModel->category) {
    $parent = Categories::find()->where(['like', 'Name', $searchModel->category])->one();
    if ($parent) {
        $pid = $parent['Id'];
        $subCategories = Categories::find()->where(['ParentId' => $pid])->orderBy(['Name' => SORT_ASC])->all();
        if (sizeof($subCategories) > 0) {

            foreach ($subCategories as $subCategory) {
                $subCategoriesSelected[$subCategory->Name] = $subCategory->Name;
            }
        }
    }
}
?>
    <div class="header-content">
        <div class="header">
            <div class="search-form">
                <?php $form = ActiveForm::begin(['method' => 'get']); ?>

                <div class="search-form-col">
                    <?= $form->field($searchModel, 'location')->textInput(['maxlength' => true, 'placeholder' => "Country of sourcing"])->label('') ?>
                </div>

                <br>
                <div class="search-form-col">
                    <?=

                    $form->field($searchModel, 'category')->dropDownList($jobs, ['prompt' => 'Product or Category', 'label' => null,
                            'onchange' => '
                                            $.post(
                                                "' . Url::toRoute('get-subcategories') . '", 
                                                {selected: $(this).val()}, 
                                                    function(res){
                                                        $("#advertsearch-position").html(res);
                                                }
                                            );
                                        ',
                            ]
                    )->label("") ?>
                </div>
                <br>
                <div class="search-form-col">
                    <?= $form->field($searchModel, 'position')->dropDownList($subCategoriesSelected,['prompt' => "Select subcategory"])->label('') ?>
                </div>
                <br>
                <?= Html::submitButton('Search', ['class' => 'search-button active btn btn-info btn-lg']) ?>
                <?php ActiveForm::end(); ?>
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

<!-- OVO NE TREBA
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
                        <?=

                        $form->field($searchModel, 'category')->dropDownList($jobs, ['prompt' => 'Product or Category', 'label' => null,
                                'onchange' => ' $.post(
                                                    "' . Url::toRoute('get-subcategories') . '", 
                                                    {selected: $(this).val()}, 
                                                        function(res){
                                                            $("#advertsearch-position").html(res);
                                                    }
                                                );
                                            ',
                            ]
                        )->label("")  ?>
                    </div>
                    <div class="search-form-col">
                        <?= $form->field($searchModel, 'position')->dropDownList([],['prompt' => "Select subcategory"])->label('') ?>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12 col-sm-offset-0,9 text-center">
                            <?=  Html::submitButton('Search', ['class' => 'active btn btn-info']) ?>
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
                    <?=  $form->field($searchModel, 'location')->textInput(['maxlength' => true, 'placeholder' => "Country of sourcing"])->label('') ?>
                    </div>
                    <div class="search-form-col">
                        <?= $form->field($searchModel, 'category')->dropDownList($jobs, ['prompt' => 'Select category', 'label' => null])->label("") ?>
                    </div>
                    <div class="col-sm-10 col-sm-offset-2 text-center">
                        <?=  Html::submitButton('Search', ['class' => 'active btn btn-info']) ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


--> 



<div class="section-menu">
    <div class="section-item">
        <a class="section-item-link" href="<?= Url::to('objava-oglasa'); ?>">
            Objava oglasa
        </a>
    </div>
    <div class="section-item">
        <a class="section-item-link" href="<?= Url::to('cjenovnik-usluge'); ?>">
            Cijenovnik i usluge
        </a>
    </div>
    <div class="section-item">
        <a class="section-item-link" href="<?= Url::to('kontakt-prodaja'); ?>">
            Kontakt prodaja
        </a>
    </div>
    <div class="section-item">
        <a class="section-item-link" href="<?= Url::to('o-nama'); ?>">
            Ko smo mi
        </a>
    </div>
    <div class="section-item">
        <a class="section-item-link" href="<?= Url::to('zasto-odabrati-nas'); ?>">
            Zašto odabrati nas
        </a>
    </div>
</div>
<!-- OVO SU ZELENI BTN-I NA MOB TAKO DA NE TREBAJU
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
                <a class="active btn btn-success" href="<?= Url::to('cjenovnik-usluge'); ?>">Cijenovnik oglasa</a>
                <a class="active btn btn-success" href="<?= Url::to('kontakt-prodaja'); ?>">Kontakt prodaja</a>
            </div>
        </div>
    </div>
</div>

-->






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


<!--
OVAJ DIO KODA IZBACI VELIKU SLIKU KADA JE MOBILE TO JE NEPOTREBNO
 <div class="hidden-lg hidden-md section section-success text-right">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <img src="<?=  Url::to('@web/css/images/hero-mob.jpg') ?>" class="hidden-lg hidden-md img-responsive">
            </div>
        </div>
    </div>
</div>
<?php //ActiveForm::end(); ?>

-->
<!--
 <div class="hidden-lg hidden-md section section-success text-right">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <img src="<?= Url::to('@web/css/images/hero-mob.jpg') ?>" class="hidden-lg hidden-md img-responsive">
            </div>
        </div>
    </div>
</div>
                                            -->
<?php ActiveForm::end(); ?>

<?php if (false && $sponsored): ?>
    <div class="section">
        <?= $sponsored->html; ?>
    </div>
<?php endif; ?>


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
    <div class="footer">
        <div>
            <div class="col-sm-6">
                <p class="text-center"></p>
                <h3 class="text-center">zaposljavanje.ba - oglasi za posao</h3>
                <p style="border-bottom: 1px solid gray;"></p>
                <p></p>
                <p class="text-center">
                    <br>Renesalis d.o.o.
                    <br>Igmanska bb - 71320 Vogošća - BiH
                    <br>
                    <a href="mailto:#">oglasi@zaposljavanje.ba</a>
                    <br>Tel: 062-332-325</p>
            </div>
            <div class="col-sm-6">
                <div class="">
                    <div class="col-md-12 hidden-lg hidden-md hidden-sm text-center">
                        <a href="https://www.instagram.com/zaposljavanje.ba/" ><i
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
                <div class="col-md-12 hidden-xs text-right" style="margin-top: 30px;">
                    <a href="https://www.instagram.com/zaposljavanje.ba/"><i
                                class="fa fa-2x fa-fw fa-instagram text-inverse"></i></a>
                    <a href="https://www.linkedin.com/company/18282027/"><i
                                class="fa fa-2x fa-fw fa-linkedin text-inverse"></i></a>
                    <a href="https://www.facebook.com/zaposljavanje.ba/"><i
                                class="fa fa-2x fa-facebook fa-fw text-inverse"></i></a>
                    <br>
                    <br>
                    <p class="text-right" style="">Preuzmite mobilnu aplikaciju za mobilne telefone i tablete</p>
                    <a href="https://itunes.apple.com/us/app/zaposljavanje/id1293977864?ls=1&mt=8"><i
                                class="fa fa-apple" style="font-size:36px"></i></a>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a
                            href="https://play.google.com/store/apps/details?id=com.zaposljavanje&hl=en"><i
                                class="fa fa-android" style="font-size:36px"></i></a>
                </div>
            </div>
          
        </div>
        <div class="text-center cop-text" style="margin-top: 20px;">
            <a class="copright-button" href="<?= Url::to('uslovi-koristenja'); ?>">Copyright
                - Privatnost - Uslovi korištenja</a>
        </div>
    </div>
</footer>
<?php if (Yii::$app->user->isGuest): ?>
    <div class="hidden-lg hidden-md section section-success">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center">
                    <a class="button-footer" id="DE-mob">Deutsch </a>
                    <a class="button-footer" id="EN-mob">English</a>
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
    });
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

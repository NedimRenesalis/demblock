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

<?php 
    $searchBar = ``
?> 
<div>
<video class="videobg" autoplay loop src="<?= Url::to("@web/css/ad.mp4"); ?>" frameborder="0"></video>
<div class="overlay"></div>
<div class="overlay2"></div>
    <div class="header">
        <div class="header-content">
            <div class="search-form">
                <?php $form = ActiveForm::begin(['method' => 'get']); ?>

                <div class="search-form-col" style="width: 172px;">
                    <?= $form->field($searchModel, 'location')
                            ->textInput(['maxlength' => true, 'placeholder' => "Country of sourcing"])
                                ->label('') ?>
                </div>

                <div class="search-form-col" style="width: 285px !important;">
                    <?= $form->field($searchModel, 'category')->dropDownList($jobs, ['prompt' => 'Product or category', 'label' => null,
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

                <div class="search-form-col" style="width: 285px !important;">
                    <?= $form->field($searchModel, 'position')->dropDownList($subCategoriesSelected,['prompt' => "Select subcategory"])->label('') ?>
                </div>
                <?= Html::submitButton('Search', ['class' => 'search-button btn btn-primary']) ?>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <span class="header-title">
           <b> VERIFIED SOURCING - WORLDWIDE </b>
        </span>
    </div>
    <div class="header-content-mobile">
        <div class="search-form-mobile">
            <?php $form = ActiveForm::begin(['method' => 'get']); ?>

            <div class="search-form-col">
                <?= $form->field($searchModel, 'location')
                        ->textInput(['maxlength' => true, 'placeholder' => "Country of sourcing"])
                            ->label('') ?>
            </div>

            <div class="search-form-col">
                <?= $form->field($searchModel, 'category')->dropDownList($jobs, ['prompt' => 'Product or Category', 'label' => null,
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

            <div class="search-form-col">
                <?= $form->field($searchModel, 'position')->dropDownList($subCategoriesSelected,['prompt' => "Select subcategory"])->label('') ?>
            </div>
            <br>
            <?= Html::submitButton('Search', ['class' => 'search-button-mobile btn btn-block btn-info']) ?>
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


<div>
    <div class="section-menu">
        <a class="section-item" href="<?= Url::to('objava-oglasa'); ?>">
            <img src=<?= Url::to('@web/css/images/section-img/objava-oglasa.png');?> style="width: 88px;"/>
            <span>List your product</span>
        </a>
        <a class="section-item" href="<?= Url::to('cjenovnik-usluge'); ?>">
            <img src=<?= Url::to('@web/css/images/section-img/cjenovnik-i-usluge.png'); ?> style="width: 74px;"/>
            <span>Listing fees</span>
        </a>
        <a class="section-item" href="<?= Url::to('kontakt-prodaja'); ?>">
            <img src=<?= Url::to('@web/css/images/section-img/kontakt-prodaja.png'); ?> />
            <span>Corporate verification</span>
        </a>
       
    </div>
</div>


<?php if ($platinum || $midi): ?>
    <?php $counter = 0; ?>
    <div>
        <?php foreach ($platinum as $p): ?>
            <?php $counter++; ?>
            <div class="premium-wrapper col-lg-2 col-sm-4 col-xs-6 col-xxs-12">
                <a target="_blank" href="<?= Url::to(['oglas', "id" => $p->id]); ?>">
                    <?php echo $this->render('_ba-sponzorisani-oglas', ['model' => $p]); ?>
                </a>
            </div>
            <?php /*if ($counter % 12 === 0): */?><!--
                <div class="col-lg-12">
                    <?php /*echo $this->render('_google_advert'); */?>
                </div>
            --><?php /*endif; */?>
        <?php endforeach; ?>
        <?php foreach ($midi as $m): ?>
            <?php $counter++; ?>
            <div class="premium-wrapper col-lg-2 col-sm-4 col-xs-6 ">
                <a target="_blank" href="<?= Url::to(['oglas', "id" => $m->id]); ?>">
                    <?php echo $this->render('_ba-sponzorisani-oglas', ['model' => $m]); ?>
                </a>
            </div>
            <?php /*if ($counter % 12 === 0): */?><!--
                <div class="col-lg-12">
                    <?php /*echo $this->render('_google_advert'); */?>
                </div>
            --><?php /*endif; */?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
                              

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
                <div class="row"  style="margin-top: 15px;">
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
                                    'template' => "{label}\n<i style='padding-top: 7px;' class='fas fa-envelope subscribe-icon' aria-hidden='true'></i>\n{input}\n{hint}\n{error}",
                                ])
                                ->textInput([
                                    'placeholder' => \Yii::t('app', 'email address'),
                                    'class' => 'form-control subscribe-input',
                                ])
                                ->label(false)?>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group no-padding no-margin sub-btn">
                                    <?=Html::submitButton(\Yii::t('app', 'Subscribe'), ['class' => 'btn btn-primary'])?>
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
                                    class="fab fa-2x fa-fw fa-instagram text-inverse"></i></a>
                        <a href="https://www.linkedin.com/company/18282027/"><i
                                    class="fab fa-2x fa-fw fa-linkedin text-inverse"></i></a>
                        <a href="https://www.facebook.com/zaposljavanje.ba/"><i
                                    class="fab fa-2x fa-facebook fa-fw text-inverse"></i></a>
                        <br>
                        <br>
                       
                    </div>
                </div>
                <div class="col-md-12 hidden-xs text-right" style="margin-top: 30px;">
                    <a href="https://www.instagram.com/zaposljavanje.ba/"><i
                                class="fab fa-2x fa-fw fa-instagram text-inverse"></i></a>
                    <a href="https://www.linkedin.com/company/18282027/"><i
                                class="fab fa-2x fa-fw fa-linkedin text-inverse"></i></a>
                    <a href="https://www.facebook.com/zaposljavanje.ba/"><i
                                class="fab fa-2x fa-facebook fa-fw text-inverse"></i></a>
                    <br>
                    <br>
                    
                </div>
                
            </div>
          
        </div>
        <div class="footer-controls">
            
            <a class="btn btn-block btn-info" style="margin-top: 5px;" href="<?= Url::to('pravila-koristenja'); ?>">
               LISTING POLICY 
            </a>
            <a class="btn btn-block btn-info" href="<?= Url::to('uvjeti-koristenja'); ?>">
                TERMS OF USE & PRIVACY POLICY
            </a>
        </div>
    </div>
</footer>


<?php if ($registered): ?>
    <div class="just-registered-wrapper">
        <div class="just-registered">
            <div class="close-img">
                <img class="image-responsive" src="<?= Url::to('@web/css/images/close.png') ?>">
            </div>
            Thank you for your registration.
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
        background-color: #e6e6fa00;
    }

    .navbar-right form {
        background-color: #e6e6fa;
    }
</style>

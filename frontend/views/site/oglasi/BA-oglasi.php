<?php

use yii\widgets\ListView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AdvertSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Zapošljavanje';
$this->params['breadcrumbs'][] = $this->title;

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
<div class="section text-justify">
    <div class="container">
        <div class="row">

                <?php $form = ActiveForm::begin(['method' => 'get']); ?>

                <div class="col-lg-3 col-md-6">
                    <?= $form->field($searchModel, 'location')->label("Grad ili država") ?>
                </div>

                <div class="col-lg-3 col-md-6">
                    <?= $form->field($searchModel, 'category')->dropDownList($jobs, ['prompt' => 'Odaberite kategoriju'])->label('Kategorija') ?>
                </div>

                <div class="form-group col-lg-3 col-md-6 search-button">
                    <?= Html::submitButton('Pretraga', ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>


<div class="section text-justify">
    <div class="container">
        <div class="row">
            <?php if ($dataProvider->totalCount > 0): ?>
            <?php echo ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_ba-oglas',
                'layout' => "{summary}\n{items}\n<div class='text-center'>{pager}</div>",
                'viewParams' => [
                    'fullView' => true,
                    'context' => 'main-page',
                    'employee' => $employee
                ],
            ]);
            ?>
            <?php else: ?>

                <?= "Nema rezultata."; ?>

            <?php endif; ?>
        </div>
    </div>
</div>

<style>
    .row{
        text-align: center;
    }
</style>

<script>

    $(document).ready(function () {
        $(".btn-apply").on("click", function () {
            var id = $(this).data('id');
             apply(id);
        });
    });

    function apply(id) {
        $.ajax({
            type: "GET",
            url: "<?php echo Yii::$app->getUrlManager()->createUrl('apply')  ; ?>",
            data: {id: id},
            success: function (response) {
                if(response == 1){
                    $(".btn-apply[data-id=" + id + "]").hide();
                    $(".btn-applied[data-applied-id=" + id + "]").show();
                }
            },
            error: function (exception) {
                alert(exception);
            }
        })
        ;
    }
</script>


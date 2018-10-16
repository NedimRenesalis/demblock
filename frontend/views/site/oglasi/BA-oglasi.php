<?php

use yii\widgets\ListView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Categories;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AdvertSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Zapošljavanje';
$this->params['breadcrumbs'][] = $this->title;



$categories = Categories::find()->where(["ParentId" => null])->orderBy(['Name' => SORT_ASC])->all();
$jobs = [];
foreach ($categories as $category) {
    $jobs[$category->Name] = $category->Name;
};
$subCategoriesSelected = [];
if($searchModel->category) {
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

<div class="section text-justify">
    <div class="container">
        <div class="row">

                <?php $form = ActiveForm::begin(['method' => 'get']); ?>

                <div class="col-lg-3 col-md-6">
                    <?= $form->field($searchModel, 'location')->label("Grad ili država") ?>
                </div>

                <div class="col-lg-3 col-md-6">
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
                        )->label('Kategorija') ?>
                </div>
            <div class="col-lg-3 col-md-6">
                <?= $form->field($searchModel, 'position')->dropDownList($subCategoriesSelected,['prompt' => "Select subcategory"])->label('Subkategorija') ?>
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



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

<div class="search-filter-container">

<div class="section text-justify search-filter">
    <h1>FILTERS</h1>
        <div class="search-filter-content">
                <?php $form = ActiveForm::begin(['method' => 'get']); ?>

                <div>
                    <?= $form->field($searchModel, 'location')->label("COUNTRY OF SOURCING") ?>
                </div>

                <div>
                    <?=
                    $form->field($searchModel, 'category')->dropDownList($jobs, ['prompt' => 'Product or category', 'label' => null,
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
                        )->label('PRODUCT OR CATEGORY') ?>
                </div>
            <div>
                <?= $form->field($searchModel, 'position')
                        ->dropDownList($subCategoriesSelected,['prompt' => "Select subcategory"])
                            ->label('SUBCATEGORY')
                ?>
            </div>
            <div>
                <?php
                $searchModel->order = 1;
                if(isset($order) && $order != '' && ($order == 1 || $order == 2)) {
                    $searchModel->order = $order;
                }
                ?>
                <?= $form->field($searchModel, 'order')
                    ->dropDownList([1 => 'Newest', 2 => 'Oldest'],['prompt' => ""])
                    ->label('SORT BY')
                ?>
            </div>
            <div class="form-group search-button-again">
                <?= Html::submitButton('SEARCH AGAIN', ['class' => 'btn btn-primary']) ?>
            </div>
                <?php ActiveForm::end(); ?>
        </div>
</div>

        <div>
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

                <span style="margin-left: 27px;"><?= "NO RESULTS"; ?></span>

            <?php endif; ?>
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



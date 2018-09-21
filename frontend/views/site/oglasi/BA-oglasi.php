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

?>
<div class="section text-justify">
    <div class="container">
        <div class="row">

                <?php $form = ActiveForm::begin(['method' => 'get']); ?>

                <div class="col-lg-3 col-md-6">
                    <?= $form->field($searchModel, 'location')->label("Grad ili država") ?>
                </div>

                <div class="col-lg-3 col-md-6">
                    <?= $form->field($searchModel, 'position')->label("Pozicija ili ime kompanije") ?>
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


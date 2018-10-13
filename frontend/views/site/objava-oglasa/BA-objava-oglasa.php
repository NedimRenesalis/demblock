<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use kartik\datetime\DateTimePicker;
use dosamigos\ckeditor\CKEditor;
use frontend\models\Categories;

$this->title = 'Zapošljavanje';


$categories = Categories::find()->where(["ParentId" => null])->orderBy(['Name' => SORT_ASC])->all();
$jobs = [];
foreach ($categories as $category) {
    $jobs[$category->Name] = $category->Name;
}
$subCategoriesSelected = [];
if($model && $model->category) {
    $parent = Categories::find()->where(['like', 'Name', $model->category])->one();
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

$types = [
    1 => "Platinum oglas",
    2 => "Izdvojeni oglas",
    3 => "Oglas prema kategoriji",
];

$payments = [
    1 => "Uplatnica - Predračun",
    3 => "Kreditna kartica",
];

$days = [
    15 => "15 (samo za Platinum oglase)",
    30 => "30",
    40 => "40 (samo za Platinum oglase)",
];

?>

<div class="col-md-12">
    <h3 class="text-center">Objava oglasa</h3>
    <br>
  <center>    <br><b>Plaćanje oglasa</b>
  <br>Oglasi se mogu platiti odmah putem kreditne kartice online ili putem uplatnice na osnovu predračuna.
  <br>
  <br>Ako odaberete uplatu putem  uplatnice kontaktirate nas emailom na <a href="mailto:#">oglasi@zaposljavanje.ba</a> ili putem telefona na 062-332-325 za izdavanje predračuna. U email-u navedite ime Vaše firme i vrstu oglasa koji želite objaviti.
  <br>Nakon izvršene uplate i nakon što novac legne na naš račun, možete Vaš oglas na našoj stranici odmah sastaviti i objaviti.
  <br>
  <br>Plaćanje putem kreditne kartice na našoj stranici Vam omogućava da odmah sastavite i objavite oglas bez kontaktiranja naše oglasne službe.
<br>
<br><b>Anonimni oglas</b>
                  <br>U slučaju da poslodavac ne želi navesti svoj identitet u oglasu, postoji
                    mogućnost objave takozvanog anonimnog oglasa, gdje umjesto loga i imena
                    kompanije koja oglašava, stoji "zaposljavanje.ba za klijenta". Anonimni
                    oglas je moguć kao dodatna opcija za sve tri vrste oglasa.</p></center>
<br>
</div>
<div class="section text-justify">
    <div class="container">
        <div class="row">
            <?php if ($message != null): ?>
                <div class="form-group no-money">
                    <?= $message; ?>
                </div>
            <?php endif; ?>
            <?php $form = ActiveForm::begin(['fieldConfig' => ['template' => '{label}{input}']]); ?>
            <div class="row text-center">
                <div class="col-md-4">

                    <?= $form->field($model, 'anonymously')->checkbox(['label' => null])->label('Objavi oglas anonimno&nbsp;&nbsp;') ?>



                    <?= $form->field($model, 'category')->dropDownList($jobs, ['prompt' => 'Country of sourcing, Product or Category', 'label' => null,
                            'onchange' => '
                                                        $.post(
                                                            "' . Url::toRoute('get-subcategories') . '", 
                                                            {selected: $(this).val()}, 
                                                                function(res){
                                                                console.log(res);
                                                                console.log($("#advert-position"));
                                                                    $("#advert-position").html(res);
                                                                    console.log($("#advert-position"));
                                                            }
                                                        );
                                                    ']
                        )->label("Country of sourcing, Product or Category  ") ?>

                    <?= $form->field($model, 'position')->dropDownList($subCategoriesSelected,['prompt' => "Select subcategory"])->label('Pozicija') ?>


                    <?= $form->field($model, 'number_of_positions')->textInput()->label('Broj pozicija') ?>

                </div>

                <div class="col-md-4">
                    <div class="form-group">

                        <?php echo '<label>Datum objave oglasa</label>'; ?>
                        <?php echo DateTimePicker::widget([
                            'model' => $model,
                            'attribute' => 'start_advert',
                            'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
                            'pluginOptions' => [
                                'autoclose' => true,
                                'startDate' => date('d-m-Y 00:00'),
                                'format' => 'd M yyyy, hh:ii'
                            ]
                        ]); ?>
                    </div>

                    <?= $form->field($model, 'contact_person')->textInput(['maxlength' => true])->label('Kontakt osoba') ?>

                    <?= $form->field($model, 'contact_email')->textInput(['maxlength' => true])->label('Kontakt email') ?>

                    <?= $form->field($model, 'web_address')->textInput(['maxlength' => true])->label('Web adresa') ?>

                </div>

                <div class="col-md-4">
                    <?= $form->field($model, 'location')->textInput(['maxlength' => true])->label('Grad') ?>

                    <?= $form->field($model, 'type')->dropDownList($types, ['prompt' => 'Odaberite tip oglasa'])->label('Vrsta oglasa') ?>

                    <?= $form->field($model, 'number_of_days')->dropDownList($days, ['prompt' => 'Odaberite'])->label('Trajanje oglasa (u danima)') ?>

                    <?= $form->field($model, 'payment')->dropDownList($payments, ['prompt' => 'Odaberite način plaćanja'])->label('Plaćanje') ?>
                </div>
            </div>

            <div class="col-lg-2"></div>
            <div class="col-lg-8 advert-description">
                <?= $form->field($model, 'description')->widget(CKEditor::className(), [
                    'options' => [
                            'rows' => 2,
                    ],
                    'preset' => 'advanced',
                    'clientOptions' => [
                            'language'=>'hr'
                    ]

                ])->label('Opis'); ?>
            </div>
            <div class="col-lg-2"></div>
        </div>
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="form-group">
                            <?= Html::submitButton('Objavi', ['class' => 'btn btn-primary']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

<?php if (!$isEmployer): ?>
    <div class="just-for-employers-wrapper">
        <div class="just-for-employers">
            Ova prijava je samo za poslodavce.
        </div>
    </div>
<?php endif; ?>


<script>

    $(document).ready(function () {
        $("#advert-anonymously").on("click", function () {

            if ($('#advert-anonymously').is(':checked')) {
                $("#advert-contact_person").val("-").prop("disabled", true);
                $("#advert-contact_email").val("-").prop("disabled", true);
                $("#advert-web_address").val("-").prop("disabled", true);
            } else {
                $("#advert-contact_person").val("").prop("disabled", false);
                $("#advert-contact_email").val("").prop("disabled", false);
                $("#advert-web_address").val("").prop("disabled", false);
            }

        });
    });
</script>

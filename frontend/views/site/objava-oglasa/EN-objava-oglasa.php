<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use kartik\datetime\DateTimePicker;
use dosamigos\ckeditor\CKEditor;

$this->title = 'Zapošljavanje';

$types = [
    1 => "Platinum Campaign",
    2 => "Featured Employer",
    3 => "Job Post inside Category",
];

$payments = [
    1 => "Payment/ deposit slip",
    3 => "Creditcard",
];

$days = [
    15 => "15 (only for Platinum)",
    30 => "30"
];

$jobs = [
    "Ostala zanimanja" => "Other",
    "Savjetovanje - Consulting usluge" => "Consulting",
    "Informatika - Hardware" => "IT - Hardware",
    "Informatika - Software" => "IT - Software",
    "Proizvodnja" => "Manufacturing",
    "Zanati" => "Handcraft",
    "Management" => "Management",
    "Poduzetništvo" => "Entrepreneurship",
    "Grafika i dizajn" => "Graphics and Design",
    "Ljudski resursi - Human Resources - HR" => "Human Resources - HR",
    "Knjigovodstvo – Revizija - Controlling" => "Accounting - Controlling",
    "Administrativne Usluge" => "Administrative Jobs",
    "Prodaja - Komercijala" => "Sales",
    "Nabavka - Supply Chain Management" => "Supply Chain Management",
    "Transport - Logistika" => "Transport - Logistics",
    "Sekretarski poslovi - Asistencija" => "Assistant",
    "Arhitektonske Usluge" => "Architecture",
    "Finansije i Bankarstvo" => "Finance and Banking",
    "Osiguranja" => "Insurance",
    "Farmacija i Biotehnologija" => "Pharmacy and Biotech",

    "Ekonomija" => "Business Administration",
    "Elektrotehnika - Mašinstvo" => "Electrical and Mechanical Engineering",
    "Energetika" => "Energy Sector",
    "Građevinarstvo" => "Building Industry",
    "Ljepota i Zdravlje" => "Beauty and Health",
    "Odnosi sa Javnošću - PR" => "Public Relations - PR",
    "Mediji" => "Media",
    "Nauka - Istraživački Radovi" => "Science and Research",
    "Nekretnine" => "Real Estate",

    "Zaštitarske Usluge" => "Security Services",
    "Rudarstvo" => "Mining",
    "Industrija" => "Industrial Production and Services",
    "Trgovina" => "Trade",
    "Zastupanje" => "Sales and Commercial Representatives",
    "Socijalne Usluge" => "Social Services",
    "NVO - Nevladine Organizacije" => "NGO",
    "Telekomunikacije" => "Telecommunications",
    "Turizam - Ugostiteljstvo - Hotelijerstvo" => "Tourism",
    "Veterina" => "Veterinary Medicine",
    "Zabava" => "Leisure",
    "Pravne Usluge" => "Legal Services"
];
?>


<div class="col-md-12">
    <h3 class="text-center">Post a job</h3>
</div>
<div class="section text-justify">
    <div class="container">
        <div class="row">
            <?php if ($message != null): ?>
                <div  class="form-group no-money">
                    <?= $message; ?>
                </div>
            <?php endif; ?>
            <?php $form = ActiveForm::begin([ 'fieldConfig' => ['template' => '{label}{input}']]); ?>
            <div class="row text-center">
                <div class="col-md-4">

                    <?= $form->field($model, 'anonymously')->checkbox(['label' => null])->label('Anonymous Job Posting&nbsp;&nbsp;') ?>

                    <?= $form->field($model, 'position')->textInput(['maxlength' => true])->label('Job title') ?>

                    <?= $form->field($model, 'category')->dropDownList($jobs, ['prompt' => 'Sector'])->label('Choose') ?>

                    <?= $form->field($model, 'number_of_positions')->textInput()->label('Total number of jobs') ?>

                </div>

                <div class="col-md-4">
                    <div class="form-group">

                        <?php echo '<label>Publication Date</label>'; ?>
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

                    <?= $form->field($model, 'contact_email')->textInput(['maxlength' => true])->label('e-mail address for incoming applications') ?>

                    <?= $form->field($model, 'web_address')->textInput(['maxlength' => true])->label('Web Site') ?>

                    <?= $form->field($model, 'contact_person')->textInput(['maxlength' => true])->label('Contact person') ?>


                </div>

                <div class="col-md-4">
                    <?= $form->field($model, 'location')->textInput(['maxlength' => true])->label('Location') ?>

                    <?= $form->field($model, 'type')->dropDownList($types, ['prompt' => 'Type'])->label('Type of job classified') ?>

                    <?= $form->field($model, 'number_of_days')->dropDownList($days, ['prompt' => 'Choose'])->label('Total publication days') ?>

                    <?= $form->field($model, 'payment')->dropDownList($payments, ['prompt' => 'Select'])->label('Method of payment') ?>

                </div>
            </div>

            <div class="col-lg-2"></div>
            <div class="col-lg-8 advert-description">
                <?= $form->field($model, 'description')->widget(CKEditor::className(), [
                    'options' => ['rows' => 2],
                    'preset' => 'advanced',
                    'clientOptions' => [
                        'language'=>'en'
                    ]
                ])->label('Job posting details'); ?>
            </div>
            <div class="col-lg-2"></div>
        </div>
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="form-group">
                            <?= Html::submitButton('Publish job posting', ['class' => 'btn btn-primary']) ?>
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
            Employer only login.
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

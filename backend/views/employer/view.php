<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use frontend\models\UserContactInformation;
use frontend\models\CompanyInformation;
use frontend\models\SourcingInformation;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Zapošljavanje';
$this->params['breadcrumbs'][] = ['label' => 'Poslodavci', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$currency = "KM";
if ($model->language == "EN" || $model->language == "DE") {
    $currency = "EUR";
}
$userContactDetails = UserContactInformation::findOne(['UserId' => $model->id]);
$userCompanyInformation = CompanyInformation::findOne(['UserId' => $model->id]);
$sourcingInformation = SourcingInformation::findOne(['UserId' => $model->id]);

?>
<div class="user-view">

    <h1><?= Html::encode("Poslodavac: " . $model->full_name) ?></h1>


    <?php if ($model->isBlocked == 0): ?>
        <a class="btn  btn-danger" href="<?= Url::to("block?id=" . $model->getId()); ?>">Blokiraj korisnika</a>
    <?php else: ?>
        <a class="btn  btn-success" href="<?= Url::to("un-block?id=" . $model->getId()); ?>">Odblokiraj korisnika</a>
        <h1>Korisnik je BLOKIRAN!</h1>
    <?php endif; ?>

    <br>
    <br>
    <?php $form = ActiveForm::begin(['id' => 'prijava-form']); ?>

    <?= $form->field($user, 'money')->textInput(['autofocus' => true, 'autocomplete' => "off"])->label("Novac (".$currency.")") ?>
    <div class="form-group">
        <?= Html::submitButton('Dodaj novac', ['class' => 'btn btn-success', 'name' => 'prijava-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <br>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Korisnicko ime',
                'attribute' => 'username',
            ],
            [
                'label' => 'Ime',
                'attribute' => 'full_name',
            ],

            [
                'label' => 'Ime kompanije',
                'attribute' => 'company_name',
            ],
            [
                'label' => 'Country',
                'attribute' => 'location',
            ],
            [
                'label' => 'Adresa',
                'attribute' => 'address',
            ],
            [
                'label' => 'Main products',
                'attribute' => 'mainProducts',
            ],
            [
                'label' => 'Novac',
                'value' => function ($model) {
                    $currency = "KM";
                    if ($model->language == "EN" || $model->language == "DE") {
                        $currency = "EUR";
                    }

                    return $model->money." ".$currency;
                }
            ],
            [
                'label' => 'Ukupni novac',
                'value' => function ($model) {
                    $currency = "KM";
                    if ($model->language == "EN" || $model->language == "DE") {
                        $currency = "EUR";
                    }

                    return $model->total_money." ".$currency;
                }
            ],
            [
                'label' => 'Registrovan',
                'value' => function ($model) {
                    return Yii::$app->formatter->asDatetime($model->created_at);
                }
            ],
            [
                'label' => 'Alternative Email',
                'value' => (($userContactDetails != null) ? $userContactDetails->AlternativeEmail : '')
            ],
            [
                'label' => 'Facebook',
                'value' => (($userContactDetails != null) ? $userContactDetails->Facebook : '')
            ],
            [
                'label' => 'Twitter',
                'value' => (($userContactDetails != null) ? $userContactDetails->Twitter : '')
            ],
            [
                'label' => 'Instagram',
                'value' => (($userContactDetails != null) ? $userContactDetails->Instagram : '')
            ],
            [
                'label' => 'Fax',
                'value' => (($userContactDetails != null) ? $userContactDetails->Fax : '')
            ],
            [
                'label' => 'Phone',
                'value' => (($userContactDetails != null) ? $userContactDetails->Phone : '')
            ],
            [
                'label' => 'Mobile',
                'value' => (($userContactDetails != null) ? $userContactDetails->Mobile : '')
            ],
            [
                'label' => 'Year Estabilished',
                'value' => (($userCompanyInformation != null) ? $userCompanyInformation->Year : '')
            ],
            [
                'label' => 'Website',
                'value' => (($userCompanyInformation != null) ? $userCompanyInformation->Website : '')
            ],
            [
                'label' => 'Number of Employees',
                'value' => (($userCompanyInformation != null) ? $userCompanyInformation->NumberOfEmployees : '')
            ],
            [
                'label' => 'Registered Address',
                'value' => (($userCompanyInformation != null) ? $userCompanyInformation->RegisteredAddress : '')
            ],
            [
                'label' => 'Operational Address',
                'value' => (($userCompanyInformation != null) ? $userCompanyInformation->OperationalAddress : '')
            ],
            [
                'label' => 'About Us',
                'value' => (($userCompanyInformation != null) ? $userCompanyInformation->AboutUs : '')
            ],
            [
                'label' => 'Annual Purchasing Volume',
                'value' => (($sourcingInformation != null) ? $sourcingInformation->AnnualPurchasingVolume : '')
            ],
            [
                'label' => 'Primary Sourcing Purpose',
                'value' => (($sourcingInformation != null) ? $sourcingInformation->PrimarySourcingPurpose : '')
            ],
            [
                'label' => 'Average Sourcing Frequency',
                'value' => (($sourcingInformation != null) ? $sourcingInformation->AverageSourcingFrequency : '')
            ],
            [
                'label' => 'Preferred Supplier Qualifications',
                'value' => (($sourcingInformation != null) ? $sourcingInformation->PreferredSupplierQualifications : '')
            ],
            [
                'label' => 'Preffered Industries',
                'value' => (($sourcingInformation != null) ? $sourcingInformation->PreferredIndustries: '')
            ],
            [
                'label' => 'Zadnja izmjena profila',
                'value' => function ($model) {
                    return Yii::$app->formatter->asDatetime($model->updated_at);
                }
            ],
        ],
    ]) ?>

</div>

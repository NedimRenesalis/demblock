<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use frontend\models\UserContactInformation;
use frontend\models\CompanyInformation;
use frontend\models\SourcingInformation;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Zapošljavanje';
$this->params['breadcrumbs'][] = ['label' => 'Posloprimci', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$userContactDetails = UserContactInformation::findOne(['UserId' => $model->id]);
$userCompanyInformation = CompanyInformation::findOne(['UserId' => $model->id]);
$sourcingInformation = SourcingInformation::findOne(['UserId' => $model->id])
?>
<div class="user-view">



    <h1><?= Html::encode("Posloprimac: " . $model->first_name . " " . $model->last_name) ?></h1>

    <?php if ($model->isBlocked == 0): ?>
        <a class="btn  btn-danger" href="<?= Url::to("block?id=".$model->getId()); ?>">Blokiraj korisnika</a>
    <?php else:?>
        <a class="btn  btn-success" href="<?= Url::to("un-block?id=".$model->getId()); ?>">Odblokiraj korisnika</a>
        <h1>Korisnik je BLOKIRAN!!</h1>
    <?php endif;?>

    <?php if ($model->image != null): ?>
        <a class="btn  btn-info" href="<?= Url::to("download-cv?id=".$model->getId()); ?>">Download CV</a>
    <?php endif;?>

    <br>
    <br>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

            [
                'label' => 'Blokiran',
                'attribute' => 'isBlocked',
            ],
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

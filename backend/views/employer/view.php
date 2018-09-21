<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Zapošljavanje';
$this->params['breadcrumbs'][] = ['label' => 'Poslodavci', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$currency = "KM";
if ($model->language == "EN" || $model->language == "DE") {
    $currency = "EUR";
}
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
                'label' => 'Jezik',
                'attribute' => 'language',
            ],
            [
                'label' => 'Ime kompanije',
                'attribute' => 'company_name',
            ],
            [
                'label' => 'PDV',
                'attribute' => 'pdv',
            ],
            [
                'label' => 'Adresa',
                'attribute' => 'address',
            ],
            [
                'label' => 'Postanski broj',
                'attribute' => 'zip_code',
            ],
            [
                'label' => 'PDV',
                'attribute' => 'pdv',
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
                'label' => 'Zadnja izmjena profila',
                'value' => function ($model) {
                    return Yii::$app->formatter->asDatetime($model->updated_at);
                }
            ],
        ],
    ]) ?>

</div>

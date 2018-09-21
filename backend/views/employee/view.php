<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Zapošljavanje';
$this->params['breadcrumbs'][] = ['label' => 'Posloprimci', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
                'label' => 'Email',
                'attribute' => 'email',
            ],
            [
                'label' => 'Jezik',
                'attribute' => 'language',
            ],
            [
                'label' => 'Ime',
                'attribute' => 'first_name',
            ],
            [
                'label' => 'Prezime',
                'attribute' => 'last_name',
            ],
            [
                'label' => 'Godina rodjena',
                'attribute' => 'year_of_birth',
            ],
            [
                'label' => 'Posao',
                'attribute' => 'job',
            ],
            [
                'label' => 'Lokacija',
                'attribute' => 'location',
            ],
            [
                'label' => 'Postanski broj',
                'attribute' => 'zip_code',
            ],
            [
                'label' => 'Spol',
                'attribute' => 'gender',
            ],

            [
                'label' => 'Struka',
                'attribute' => 'career_level',
            ],
            [
                'label' => 'Obrazovanje',
                'attribute' => 'education_level',
            ],
            [
                'label' => 'Dodatno iskustvo',
                'attribute' => 'additional_experience',
            ],
            [
                'label' => 'Telefon',
                'attribute' => 'phone',
            ],

            [
                'label' => 'Registrovan',
                'value' => function ($model) {
                    return Yii::$app->formatter->asDatetime($model->created_at);
                }
            ],
            [
                'label' => 'Zadnja promjena profila',
                'value' => function ($model) {
                    return Yii::$app->formatter->asDatetime($model->updated_at);
                }
            ],
        ],
    ]) ?>

</div>

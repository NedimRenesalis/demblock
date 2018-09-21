<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\User;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Advert */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Oglasi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="advert-view">

    <?php if ($model->isPublished == 0): ?>
        <a class="btn  btn-success" href="<?= Url::to("publish?id=" . $model->getId()); ?>">Objavi oglas</a>
    <?php else: ?>
        <a class="btn  btn-danger" href="<?= Url::to("un-publish?id=" . $model->getId()); ?>">Skloni oglas</a>
    <?php endif; ?>

    <a class="btn  btn-info" target="_blank" href="<?= Url::to("html?id=" . $model->getId()); ?>">HTML Izvjestaj</a>
    <a class="btn  btn-info" target="_blank" href="<?= Url::to("pdf?id=" . $model->getId()); ?>">PDF Izvjestaj</a>

    <p></p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Poslodavac',
                'value' => function ($model) {

                    $user = User::find()->where((["id" =>$model->user_id]))->one();
                    return $user->full_name . " - " . $user->company_name;
                }

            ],
            [
                'label' => 'Cijena',
                'attribute' => 'price',
            ],
            [
                'label' => 'Pozicija',
                'attribute' => 'position',
            ],
            [
                'label' => 'Kreirano',
                'value' => function ($model) {
                    return Yii::$app->formatter->asDatetime($model->created_at);
                }
            ],
            [
                'label' => 'Pocetak',
                'value' => function ($model) {
                    return Yii::$app->formatter->asDatetime($model->start_advert);
                }
            ],
            [
                'label' => 'Kraj',
                'value' => function ($model) {
                    return Yii::$app->formatter->asDatetime($model->end_advert);
                }
            ],
            [
                'label' => 'Broj dana',
                'attribute' => 'number_of_days',
            ],
            [
                'label' => 'Broj pozicija',
                'attribute' => 'number_of_positions',
            ],
            [
                'label' => 'Web adresa',
                'attribute' => 'web_address',
            ],
            [
                'label' => 'Email',
                'attribute' => 'contact_email',
            ],
            [
                'label' => 'Kontakt osoba',
                'attribute' => 'contact_person',
            ],
            [
                'label' => 'Lokacija',
                'attribute' => 'location',
            ],
            [
                'label' => 'Kategorija',
                'attribute' => 'category',
            ],
            [
                'label' => 'Tip',
                'value' => function ($model) {
                    switch ($model->type) {
                        case 1:
                            return "Platinum";
                            break;
                        case 2:
                            return "Premium";
                            break;
                        case 3:
                            return "Normal";
                            break;
                    }
                }
            ],
            [
                'label' => 'Anonimno',
                'value' => function ($model) {
                    switch ($model->anonymously) {
                        case 0:
                            return "NO";
                            break;
                        case 1:
                            return "YES";
                            break;
                    }
                }
            ],
            [
                'label' => 'Način plaćanja',
                'value' => function ($model) {
                    switch ($model->payment) {
                        case 1:
                            return "Po predračunu - uplatnicom";
                            break;
                        case 3:
                            return "Kreditna kartica";
                            break;
                    }
                }
            ],
            [
                'label' => 'Opis',
                'attribute' => 'description',
            ],
            [
                'label' => 'Objavljen',
                'attribute' => 'isPublished',
            ],
        ],
    ]) ?>

</div>

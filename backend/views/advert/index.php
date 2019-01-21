<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\Advert;
use backend\models\Categories;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\AdvertSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'demblock';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="advert-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'label' => 'ID',
                'attribute' => 'id',
            ],
            [
                'label' => 'Poziicja',
                'attribute' => 'position',
            ],
            [
                'label' => 'Kreirano',
                'attribute' => 'created_at',
                'value' => function ($model) {
                    return Yii::$app->formatter->asDate($model->created_at);
                },
                'filter' => [
                        0 => "Svi",
                        Yii::$app->formatter->asTimestamp(date("Y-m-d H:i:s")) - 1 * 10 * 60 * 60 => "10 sati",

                        Yii::$app->formatter->asTimestamp(date("Y-m-d H:i:s")) - 1 * 24 * 60 * 60 => "24 sata",

                        Yii::$app->formatter->asTimestamp(date("Y-m-d H:i:s")) - 2 * 24 * 60 * 60 => "48 sati",

                        Yii::$app->formatter->asTimestamp(date("Y-m-d H:i:s")) - 7 * 24 * 60 * 60 => "7 dana",

                        Yii::$app->formatter->asTimestamp(date("Y-m-d H:i:s")) - 10 * 24 * 60 * 60 => "10 dana",

                        Yii::$app->formatter->asTimestamp(date("Y-m-d H:i:s")) - 30 * 24 * 60 * 60 => "30 dana",

                ]
            ],
            [
                'label' => 'Pocetak objave',
                'attribute' => 'start_advert',
                'value' => function ($model) {
                    return Yii::$app->formatter->asDate($model->start_advert);
                },
                'filter' => [
                    0 => "Svi",
                    Yii::$app->formatter->asTimestamp(date("Y-m-d H:i:s")) - 1 * 10 * 60 * 60 => "10 sati",

                    Yii::$app->formatter->asTimestamp(date("Y-m-d H:i:s")) - 1 * 24 * 60 * 60 => "24 sata",

                    Yii::$app->formatter->asTimestamp(date("Y-m-d H:i:s")) - 2 * 24 * 60 * 60 => "48 sati",

                    Yii::$app->formatter->asTimestamp(date("Y-m-d H:i:s")) - 7 * 24 * 60 * 60 => "7 dana",

                    Yii::$app->formatter->asTimestamp(date("Y-m-d H:i:s")) - 10 * 24 * 60 * 60 => "10 dana",

                    Yii::$app->formatter->asTimestamp(date("Y-m-d H:i:s")) - 30 * 24 * 60 * 60 => "30 dana",

                ]
            ],
            [
                'label' => 'Broj dana',
                'attribute' => 'number_of_days',
            ],
            [
                'label' => 'Objavljen',
                'attribute' => 'isPublished',
            ],
            [
                'label' => 'Kategorija',
                'attribute' => 'category',
                'filter' => ArrayHelper::map(Categories::find()->asArray()->where(['ParentId' => null])->all(), 'Name', 'Name')
            ],
            [
                'label' => 'Tip',
                'attribute' => 'type',
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
                },
                'filter' => Html::activeDropDownList($searchModel, 'type',
                    [
                        1 => "Platinum",
                        2 => "Premium",
                        3 => "Normal"
                    ],
                    ['class' => 'form-control', 'prompt' => 'Izaberi']),
            ],
            [
                'label' => 'Anonimno',
                'attribute' => 'anonymously',
                'value' => function ($model) {
                    switch ($model->anonymously) {
                        case 0:
                            return "NO";
                            break;
                        case 1:
                            return "YES";
                            break;
                    }
                },
                'filter' => array(
                    0 => "NO",
                    1 => "YES",
                ),
            ],
            [
                'label' => 'Placanje',
                'attribute' => 'payment',
                'value' => function ($model) {
                    switch ($model->payment) {
                        case 1:
                            return "Predračun";
                            break;
                        case 3:
                            return "Kreditna";
                            break;
                    }
                },
                'filter' => array(
                    1 => "Predračun",
                    2 => "Paypal",
                    3 => "Kreditna",
                ),
            ],
            [
                'label' => 'Cijena',
                'attribute' => 'price',
                'value' => function ($model) {
                    $user = \common\models\User::findOne(['id' => $model->user_id]);

                    switch ($user->language) {
                        case "DE":
                            return $model->price . " €";
                            break;
                        case "EN":
                            return $model->price . " €";
                            break;
                        default:
                            return $model->price . " KM";
                            break;
                    }
                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MessageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Sent');
$this->params['breadcrumbs'][] = $this->title;

rmrevin\yii\fontawesome\AssetBundle::register($this);

?>
<div class="d-block">
    <div class="message">

        <div class="info-header">
            <h3><?= Html::encode($this->title) ?></h3>
        </div>

        <div class="info-content">
            <div class="text-right">
                <?= Html::a(Yii::t('app', 'Write a message') . ' <i class="fa fa-plus"></i>', ['compose'], ['class' => 'btn btn-success']) ?>
            </div>

            <?php Pjax::begin(); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'id' => 'message-inbox',
                'columns' => [
                    [
                        'headerOptions' => ['style' => 'width: 200px;'],
                        'attribute' => 'to',
                        'format' => 'raw',
                        'value' => function ($message) {
                            if ($message->recipient) {
                                return ($message->recipient->company_name != '') ? $message->recipient->company_name : (($message->recipient->full_name != '') ? $message->recipient->full_name : $message->recipient->username);
                            }
                        },
                        'filter' => $users,
                    ],
                    [
                        'headerOptions' => ['style' => 'width: 200px;'],
                        'attribute' => 'created_at',
                        'format' => 'datetime',
                    ],
                    [
                        'attribute' => 'title',
                        'format' => 'raw', // do not use 'format' => 'html' because the 'data-pjax=0' gets swallowed.
                        'value' => function ($data) {
                            return Html::a($data->title, ['view', 'hash' => $data->hash], ['data-pjax' => 0]);
                        },
                    ],
                ],
            ]); ?>

            <?php Pjax::end(); ?>
        </div>
    </div>
</div> 
<?php
use app\models\Message;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $searchModel app\models\MessageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Inbox');
$this->params['breadcrumbs'][] = $this->title;


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
                        'attribute' => 'from',
                        'format' => 'raw',
                        'value' => function ($message) {
                            return ($message->sender->company_name != '') ? $message->sender->company_name : (($message->sender->full_name != '') ? $message->sender->full_name : $message->sender->username);
                        },
                        'filter' => $users,
                    ],
                    [
                        'headerOptions' => ['style' => 'width: 200px;'],
                        'attribute' => 'created_at',
                        'format' => 'datetime',
                        'filter' => false,
                    ],
                    [
                        'attribute' => 'title',
                        'format' => 'raw', // do not use 'format' => 'html' because the 'data-pjax=0' gets swallowed.
                        'value' => function ($data) {
                            return Html::a($data->title, ['view', 'hash' => $data->hash], ['data-pjax' => 0]);
                        },
                    ],
                    [
                        'headerOptions' => ['style' => 'width: 150px;'],
                        'filter' => [
                            0 => Yii::t('app', 'unread'),
                            1 => Yii::t('app', 'read'),
                            2 => Yii::t('app', 'answered'),
                        ],
                        'attribute' => 'status',
                        'format' => 'raw',
                        'value' => function ($data) {
                            switch ($data->status) {
                                case Message::STATUS_UNREAD:
                                    return '<span class="glyphicon glyphicon-envelope" title="' . Yii::t('app', 'unread') . '">';
                                    break;
                                case Message::STATUS_READ:
                                    return '<span class="glyphicon glyphicon-ok" title="' . Yii::t('app', 'read') . '">';
                                    break;
                                case Message::STATUS_ANSWERED:
                                    return '<span class="glyphicon glyphicon-repeat" title="' . Yii::t('app', 'answered') . '">';
                                    break;
                            }
                        },
                    ],
                    [
                        'headerOptions' => ['style' => 'width: 50px;'],
                        'filter' => false,
                        'format' => 'raw',
                        'value' => function ($data) {
                            return Html::a('<i class="glyphicon glyphicon-remove">', ['delete', 'hash' => $data->hash], [
                                'data-pjax' => 0,
                                'data-method' => 'POST',
                                'data-confirm' => Yii::t('app', 'Are you sure you want to delete this message?'),
                                'title' => Yii::t('app', 'Delete message'),
                            ]);
                        }
                    ],
                ],
            ]); ?>

            <?php Pjax::end(); ?>
        </div>
    </div>
</div> 
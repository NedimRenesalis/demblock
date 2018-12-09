<?php

use thyseus\message\models\Message;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $message app\models\Message */

$this->title = $message->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Inbox'), 'url' => ['inbox']];
$this->params['breadcrumbs'][] = 'Nachricht: ' . $this->title;

rmrevin\yii\fontawesome\AssetBundle::register($this);
?>
<div class="message-view">
    <br>
    <p>
        <?php
        $ignored = Message::isUserIgnoredBy($message->from, Yii::$app->user->id);
        if ($message->from != Yii::$app->user->id) {
            if ($ignored) {
                echo Html::tag('span', Yii::t('app', 'Answer'), [
                    'class' => 'btn btn-primary disabled',
                    'title' => $ignored ? Yii::t(
                        'app', 'The recipient has added you to the ignore list. You can not send any messages to this person.') : '',
                ]);
            } else {
                echo Html::a('<i class="fa fa-reply" aria-hidden="true"></i> ' . Yii::t('app', 'Answer'), [
                    'compose', 'to' => $message->from, 'answers' => $message->hash]);
            }
        }
        ?>

        <?php
        if ($message->to == Yii::$app->user->id) {
            echo Html::a('<i class="fa fa-remove"></i> ' . Yii::t('app', 'Delete'), ['delete', 'hash' => $message->hash], [
                'class' => 'text-red ml',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this message?'),
                    'method' => 'post',
                ],
            ]);
        }
        ?>
    </p>
    <?php
        $from = ($message->sender->company_name != '') ? $message->sender->company_name : (($message->sender->full_name != '') ? $message->sender->full_name : $message->sender->username);
    $to = ($message->recipient->company_name != '') ? $message->recipient->company_name : (($message->recipient->full_name != '') ? $message->recipient->full_name : $message->recipient->username);

    ?>
    <hr>

    <div class="panel panel-default">
        <div class="panel-heading">
            <?= Yii::t('app', 'title'); ?>: <?= Html::encode($this->title) ?>
        </div>
        <div class="panel-body">
            <?= $message->message ? $message->message : ('<mark>' . Yii::t('app', 'No message content given') . '.</mark>'); ?>
        </div>
        <div class="panel-footer">
            <small> <?= Yii::t('app', 'Message from'); ?>: <?= $from ?><br>
                <?= Yii::t('app', 'sent at'); ?>: <?= Yii::$app->formatter->asDate($message->created_at, 'long'); ?>
                <?= Yii::t('app', 'at'); ?> <?= Yii::$app->formatter->asDate($message->created_at, 'php:H:i:s'); ?> Uhr<br>
                <?php if ($message->context) : ?>
                    <?= Yii::t('app', 'Referring to'); ?>: <?= $message->context; ?>
                <?php endif; ?>
            </small>
        </div>
    </div>
    <hr>
    <?= Html::a('<i class="fa fa-arrow-left" aria-hidden="true"></i> ' . Yii::t('app', 'Back to Inbox'), ['/message/inbox']) ?>
</div>
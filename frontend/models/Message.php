<?php

namespace app\models;

use common\models\User;
use yii;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use frontend\models\AllowedContacts;

/**
 * This is the model class for table "message".
 *
 * @property int $id
 * @property string $hash
 * @property int $from
 * @property int $to
 * @property int $status
 * @property string $title
 * @property string $message
 * @property string $created_at
 * @property string $context
 */
class Message extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = -1;
    const STATUS_UNREAD = 0;
    const STATUS_READ = 1;
    const STATUS_ANSWERED = 2;

    const EVENT_BEFORE_MAIL = 'before_mail';
    const EVENT_AFTER_MAIL = 'after_mail';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'message';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['to', 'title'], 'required'],
            [['to'], 'integer'],
            [['title', 'message', 'context'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['to'], 'exist',
                'targetClass' => User::className(),
                'targetAttribute' => 'id',
                'message' => Yii::t('app', 'Recipient has not been found'),
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '#'),
            'from' => Yii::t('app', 'from'),
            'to' => Yii::t('app', 'to'),
            'title' => Yii::t('app', 'title'),
            'message' => Yii::t('app', 'message'),
            'created_at' => Yii::t('app', 'sent at'),
            'context' => Yii::t('app', 'context'),
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => AttributeBehavior::className(),
                'attributes' => [ActiveRecord::EVENT_BEFORE_INSERT => 'hash'],
                'value' => md5(uniqid(rand(), true)),
            ],
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => null,
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public static function compose($from, $to, $title, $message = '', $context = null)
    {
        $model = new Message;
        $model->from = $from;
        $model->to = $to;
        $model->title = $title;
        $model->message = $message;
        $model->context = $context;
        return $model->save();
    }

    public static function getPossibleRecipients($for_user)
    {
        $user = new User();

        $ignored_users = [];

        $users = $user::find();
        $users->where(['!=', 'id', Yii::$app->user->id]);

        return $users->all();

    }

    public function beforeValidate()
    {
        if (!$this->from)
            $this->from = Yii::$app->user->id;

        return parent::beforeValidate();
    }

    public function afterSave($insert, $changedAttributes)
    {
        if ($insert && isset($this->recipient->email)) {
            $this->sendEmailToRecipient();
        }

        return parent::afterSave($insert, $changedAttributes);
    }

    // returns an array of possible recipients for the given user. Applies the ignorelist and applies possible custom
    // logic.

    public function sendEmailToRecipient()
    {
        $this->trigger(Message::EVENT_BEFORE_MAIL);

        Yii::$app->mailer->compose(['html' => 'message', 'text' => 'text/message'], ['content' => $this->message])
            ->setTo($this->recipient->email)
            ->setFrom(Yii::$app->params['adminEmail'])
            ->setSubject($this->title)
            ->send();

        $this->trigger(Message::EVENT_AFTER_MAIL);
    }

    public function delete()
    {
        return $this->updateAttributes(['status' => Message::STATUS_DELETED]);
    }

    public function getRecipientLabel()
    {
        if (!$this->recipient)
            return Yii::t('app', 'Removed user');
        else
            return $this->recipient->username;
    }

    public function getAllowedContacts()
    {
        return $this->hasOne(AllowedContacts::className(), ['id' => 'user_id']);
    }

    public function getRecipient()
    {
        return $this->hasOne(User::className(), ['id' => 'to']);
    }

    public function getSender()
    {
        return $this->hasOne(User::className(), ['id' => 'from']);
    }
}

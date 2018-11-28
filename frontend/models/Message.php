<?php

namespace app\models;

use Yii;

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
            [['hash', 'title', 'created_at', 'context'], 'required'],
            [['from', 'to', 'status'], 'integer'],
            [['message'], 'string'],
            [['created_at'], 'safe'],
            [['hash'], 'string', 'max' => 32],
            [['title', 'context'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'hash' => Yii::t('app', 'Hash'),
            'from' => Yii::t('app', 'From'),
            'to' => Yii::t('app', 'To'),
            'status' => Yii::t('app', 'Status'),
            'title' => Yii::t('app', 'Title'),
            'message' => Yii::t('app', 'Message'),
            'created_at' => Yii::t('app', 'Created At'),
            'context' => Yii::t('app', 'Context'),
        ];
    }
}

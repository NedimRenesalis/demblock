<?php

namespace backend\models;

use Yii;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%subscribers}}".
 *
 * @property string $email
 */
class Subscribe extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%subscribers}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            [['email'], 'required'],
            ['email', 'email'],
            [
                'email', 'unique',
                'targetClass' => 'backend\models\Subscribe'
            ],
            [['created_at', 'updated_at'], 'safe'],
            [['created_at'], 'default', 'value' => new Expression('NOW()')],
            [['updated_at'], 'default', 'value' => new Expression('NOW()')],
            [['email'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id'       => 'User ID',
            'email'         => 'Email',
            'created_at'    => 'Created At',
            'updated_at'    => 'Updated At'
        ];
    }

    /**
     * @inheritdoc
     */
    public static function getEmailField()
    {
        return 'email';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmails()
    {
        return $this->hasMany(Subscribe::className(), ['email' => 'email']);
    }
}
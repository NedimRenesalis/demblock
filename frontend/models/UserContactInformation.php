<?php

namespace app\models;
use common\models\User;
use Yii;

/**
 * This is the model class for table "user_contact_information".
 *
 * @property int $Id
 * @property string $Email
 * @property string $AlternativeEmail
 * @property string $Phone
 * @property string $Fax
 * @property string $Mobile
 * @property string $Facebook
 * @property string $Twitter
 * @property string $Instagram
 * @property int $UserId
 *
 * @property User $user
 */
class UserContactInformation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_contact_information';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Email', 'UserId'], 'required'],
            [['UserId'], 'integer'],
            [['Email', 'AlternativeEmail', 'Phone', 'Fax', 'Mobile', 'Facebook', 'Twitter', 'Instagram'], 'string', 'max' => 255],
            [['Email'], 'unique'],
            [['UserId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['UserId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => Yii::t('app', 'ID'),
            'Email' => Yii::t('app', 'Email'),
            'AlternativeEmail' => Yii::t('app', 'Alternative Email'),
            'Phone' => Yii::t('app', 'Phone'),
            'Fax' => Yii::t('app', 'Fax'),
            'Mobile' => Yii::t('app', 'Mobile'),
            'Facebook' => Yii::t('app', 'Facebook'),
            'Twitter' => Yii::t('app', 'Twitter'),
            'Instagram' => Yii::t('app', 'Instagram'),
            'UserId' => Yii::t('app', 'User ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'UserId']);
    }
}

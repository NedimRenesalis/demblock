<?php

namespace app\models;
use common\models\User;
use Yii;


/**
 * This is the model class for table "company_information".
 *
 * @property int $Id
 * @property string $CompanyName
 * @property string $Year
 * @property string $Website
 * @property int $NumberOfEmployees
 * @property string $RegisteredAddress
 * @property string $OperationalAddress
 * @property string $AboutUs
 * @property int $UserId
 *
 * @property User $user
 */
class CompanyInformation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company_information';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Year'], 'safe'],
            [['NumberOfEmployees', 'UserId'], 'integer'],
            [['UserId'], 'required'],
            [['CompanyName', 'Website', 'RegisteredAddress', 'OperationalAddress'], 'string', 'max' => 255],
            [['AboutUs'], 'string', 'max' => 500],
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
            'CompanyName' => Yii::t('app', 'Company Name'),
            'Year' => Yii::t('app', 'Year'),
            'Website' => Yii::t('app', 'Website'),
            'NumberOfEmployees' => Yii::t('app', 'Number Of Employees'),
            'RegisteredAddress' => Yii::t('app', 'Registered Address'),
            'OperationalAddress' => Yii::t('app', 'Operational Address'),
            'AboutUs' => Yii::t('app', 'About Us'),
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

<?php

namespace frontend\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "sourcing_information".
 *
 * @property int $Id
 * @property string $AnnualPurchasingVolume
 * @property string $PrimarySourcingPurpose
 * @property string $AverageSourcingFrequency
 * @property string $PreferredSupplierQualifications
 * @property string $PreferredIndustries
 * @property int $UserId
 *
 * @property User $user
 */
class SourcingInformation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sourcing_information';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['UserId'], 'required'],
            [['UserId'], 'integer'],
            [['AnnualPurchasingVolume', 'PrimarySourcingPurpose', 'AverageSourcingFrequency', 'PreferredSupplierQualifications', 'PreferredIndustries'], 'string', 'max' => 1500],
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
            'AnnualPurchasingVolume' => Yii::t('app', 'Annual Purchasing Volume'),
            'PrimarySourcingPurpose' => Yii::t('app', 'Primary Sourcing Purpose'),
            'AverageSourcingFrequency' => Yii::t('app', 'Average Sourcing Frequency'),
            'PreferredSupplierQualifications' => Yii::t('app', 'Preferred Supplier Qualifications'),
            'PreferredIndustries' => Yii::t('app', 'Preferred Industries'),
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

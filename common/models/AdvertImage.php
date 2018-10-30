<?php

namespace common\models;

use Yii;
use common\models\Advert;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Url;

/**
 * This is the model class for table "{{%advert_image}}".
 *
 * @property integer $image_id
 * @property integer $advert_id
 * @property string $image_path
 * @property integer $sort_order
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Company $company
 */
class AdvertImage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%advert_image}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'value' => date('Y-m-d G:i:s'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['advert_id', 'sort_order'], 'integer'],
            [['created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['image_path'], 'string', 'max' => 255],
            [['advert_id'], 'exist', 'skipOnError' => true, 'targetClass' => Advert::className(), 'targetAttribute' => ['advert_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'image_id' => 'Image ID',
            'advert_id' => 'Company ID',
            'image_path' => 'Image Path',
            'sort_order' => 'Sort Order',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Advert::className(), ['advert_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAbsImage()
    {
        return Url::base('') . $this->image_path;
    }

    
    /**
     * @inheritdoc
     * @return AdvertImageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AdvertImageQuery(get_called_class());
    }
}

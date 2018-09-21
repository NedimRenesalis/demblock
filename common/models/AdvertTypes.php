<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "advert_types".
 *
 * @property integer $id
 * @property string $title
 * @property string $type
 * @property string $language
 * @property integer $days
 * @property integer $price
 * @property integer $positions
 */
class AdvertTypes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'advert_types';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['days', 'price', 'positions'], 'required'],
            [['days', 'positions'], 'integer'],
            [['price'], 'number'],
            [['title', 'language', 'type'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'type' => 'Type',
            'language' => 'Language',
            'days' => 'Days',
            'price' => 'Price',
            'positions' => 'Positions',
        ];
    }
}

<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * This is the model class for table "categories".
 *
 * @property int $Id
 * @property int $ParentId
 * @property string $Name
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ParentId'], 'integer'],
            [['Name'], 'required'],
            [['Name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => Yii::t('app', 'ID'),
            'ParentId' => Yii::t('app', 'Parent ID'),
            'Name' => Yii::t('app', 'Name'),
        ];
    }
}

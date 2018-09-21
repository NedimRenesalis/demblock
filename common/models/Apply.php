<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "apply".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $advert_id
 */
class Apply extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'apply';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'advert_id'], 'required'],
            [['user_id', 'advert_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'advert_id' => 'Advert ID',
        ];
    }
}

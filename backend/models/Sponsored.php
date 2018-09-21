<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sponsored".
 *
 * @property integer $id
 * @property string $title
 * @property string $html
 * @property integer $isPublished
 */
class Sponsored extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sponsored';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['html', 'title'], 'string'],
            [['isPublished'], 'integer'],
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
            'html' => 'Html',
            'isPublished' => 'Is Published',
        ];
    }
}

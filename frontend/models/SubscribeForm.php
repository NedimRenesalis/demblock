<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * Subscribe model. Email.
 */
class SubscribeForm extends Model
{
    /**
     * @var string
     */
    public $email = '';

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        $rules = [
            ['email', 'email'],
            [['email'], 'string', 'max' => 100]
        ];

        return $rules;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'email'    =>  \Yii::t('app', 'Email Address')
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function subscribePageAttribute() {
        return [
            'page_id'  =>  'subscribe-form'
        ];
    }
}

<?php

namespace backend\models;

use yii\base\Model;


class ChangePasswordForm extends Model
{
    public $password;
    public $oldPassword;
    public $confirmPassword;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['password', 'confirmPassword'], 'string', 'min' => 6],
            [['oldPassword', 'password', 'confirmPassword'], 'required'],
            ['confirmPassword', 'compare', 'compareAttribute' => 'password', 'message' => "Passwords don't match"],
        ];
    }

}

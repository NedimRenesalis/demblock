<?php

namespace frontend\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupEmployeeForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $confirm_password;

    public $first_name;
    public $last_name;
    public $year_of_birth;
    public $gender;
    public $education_level;
    public $career_level;
    public $additional_experience;
    public $job;
    public $location;
    public $phone;
    public $language;
    public $user_type;
    public $zip_code;

    public $company_name;
    public $full_name;
    public $pdv;

    public $captcha;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            ['captcha', 'required'],
            ['captcha', 'captcha'],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['confirm_password', 'required'],
            ['confirm_password', 'compare', 'compareAttribute' => 'password', 'message' => "Passwords don't match"],

            [['first_name', 'money', 'last_name', 'year_of_birth', 'gender', 'education_level',
                'career_level', 'additional_experience', 'phone', 'language', 'job', 'location', 'isBlocked','zip_code'], 'safe'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->last_name = $this->last_name;
        $user->first_name = $this->first_name;
        $user->year_of_birth = $this->year_of_birth;
        $user->gender = $this->gender;
        $user->education_level = $this->education_level;
        $user->career_level = $this->career_level;
        $user->additional_experience = $this->additional_experience;
        $user->phone = $this->phone;
        $user->zip_code = $this->zip_code;

        $user->job = $this->job;
        $user->location = $this->location;

        $user->company_name = '-';
        $user->full_name = '-';
        $user->pdv = '-';
        $user->money = 0;

        $user->isBlocked = 0;

        $user->user_type = $this->user_type;
        $user->language = $this->language;

        $user->setPassword($this->password);
        $user->generateAuthKey();

        return $user->save() ? $user : null;
    }
}

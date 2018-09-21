<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupEmployerForm extends Model
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
    public $company_description;
    public $phone;
    public $language;
    public $user_type;

    public $company_name;
    public $full_name;
    public $pdv;
    public $address;
    public $zip_code;

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
            ['company_description', 'string', 'max' => 500],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['confirm_password', 'required'],
            ['confirm_password', 'compare', 'compareAttribute'=>'password', 'message'=>"Passwords don't match" ],

            [['first_name','last_name','year_of_birth','gender', 'education_level', 'career_level','additional_experience',
                'phone','language', 'address','company_name', 'pdv', 'full_name', 'zip_code'], 'safe'],
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
        $money = 0;

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->phone = $this->phone;
        $user->company_name = $this->company_name;
        $user->full_name = $this->full_name;
        $user->pdv = $this->pdv;
        $user->address = $this->address;
        $user->zip_code = $this->zip_code;
        $user->company_description = $this->company_description;

        $user->last_name = "-";
        $user->first_name = "-";
        $user->year_of_birth = "-";
        $user->gender = "-";
        $user->education_level = "-";
        $user->career_level = "-";
        $user->additional_experience = "-";
        $user->job = "-";
        $user->location = "-";

        $user->user_type = $this->user_type;
        $user->language = $this->language;

        $user->isBlocked = 0;

        $user->money = $money;

        $user->setPassword($this->password);
        $user->generateAuthKey();

        return $user->save() ? $user : null;
    }
}

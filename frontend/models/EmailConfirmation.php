<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Password reset request form
 */
class EmailConfirmation extends Model
{
    public $email;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => '\common\models\User',
                'filter' => ['status' => User::STATUS_INACTIVE],
                'message' => 'There is no user with this email address.'
            ],
        ];
    }

    /**
     * Sends an email with a link, for email confirmation.
     *
     * @return bool whether the email was send
     */
    public function sendEmail($user)
    {
        if ($user->status != User::STATUS_INACTIVE) {
            return false;
        }

        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'activate-profile-html'],
                ['user' => $user]
            )
            ->setFrom("admir.etf@gmail.com")
            ->setTo($user->email)
            ->setSubject('Profile activation')
            ->send();
    }

}

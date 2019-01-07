<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
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
                'filter' => ['status' => User::STATUS_ACTIVE],
                'message' => 'There is no user with this email address.'
            ],
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return bool whether the email was send
     */
    public function sendEmail()
    {
        /* @var $user User */
        $user = User::findOne([
            'status' => User::STATUS_ACTIVE,
            'email' => $this->email,
        ]);

        if (!$user) {
            return false;
        }
        
        if (!User::isPasswordResetTokenValid($user->password_reset_token)) {
            $user->generatePasswordResetToken();
            if (!$user->save()) {
                return false;
            }
        }

        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'],
                ['user' => $user]
            )
            ->setFrom("support@demblock.com")
            ->setTo($this->email)
            ->setSubject('Zaposljavanje.BA - Password reset')
            ->send();
    }

    public function sendEmailLang($language)
    {
        /* @var $user User */
        $user = User::findOne([
            'status' => User::STATUS_ACTIVE,
            'email' => $this->email,
        ]);

        if (!$user) {
            return false;
        }

        if (!User::isPasswordResetTokenValid($user->password_reset_token)) {
            $user->generatePasswordResetToken();
            if (!$user->save()) {
                return false;
            }
        }

        $mailContent =  ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'];
        $subject = 'Zaposljavanje.BA - Password reset';
        if($language == "BA"){
            $mailContent =  ['html' => 'passwordResetToken-BA-html', 'text' => 'passwordResetToken-BA-text'];
            $subject = 'Zaposljavanje.BA - Promjena lozinke';
        }else if($language == "DE"){
            $mailContent =  ['html' => 'passwordResetToken-DE-html', 'text' => 'passwordResetToken-DE-text'];
            $subject = 'Zaposljavanje.BA - Passwort zurücksetzen';
        }

        return Yii::$app
            ->mailer
            ->compose(
                $mailContent,
                ['user' => $user]
            )
            ->setFrom("support@demblock.com")
            ->setTo($this->email)
            ->setSubject($subject)
            ->send();
    }
}

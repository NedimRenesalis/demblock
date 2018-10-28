<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $first_name
 * @property string $last_name
 * @property string $full_name
 * @property string $year_of_birth
 * @property string $gender
 * @property string $language
 * @property string $job
 * @property string $location
 * @property string $career_level
 * @property string $education_level
 * @property string $additional_experience
 * @property string $company_name
 * @property string $phone
 * @property string $pdv
 * @property float $model
 * @property float $total_money
 * @property string $isBlocked
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $address
 * @property string $company_description
 * @property string $banner
 * @property string $zip_code
 * @property string $auth_key
 * @property integer $status
 * @property integer $user_type
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            [['money', 'total_money'],'integer', 'integerOnly' => false],
            [['company_description'], 'string'],
            [['first_name', 'money', 'last_name', 'year_of_birth', 'gender', 'education_level', 'career_level', 'additional_experience',
                'phone', 'language', 'address', 'company_name', 'pdv', 'full_name', 'email', 'job', 'location', 'isBlocked', 'zip_code','company_description', 'banner'], 'filter', 'filter' => '\yii\helpers\HtmlPurifier::process']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int)substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(CompanyImage::className(), ['company_id' => 'id']);
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function getUserType()
    {
        return $this->user_type;
    }

    public static function getUserTypeByUsername($userName)
    {
        $user = (new \yii\db\Query())
            ->from('user')
            ->where(['username' => $userName])
            ->one();
        return $user['user_type'];
    }

    public static function getUserLanguageByUsername($userName)
    {
        $user = (new \yii\db\Query())
            ->from('user')
            ->where(['username' => $userName])
            ->one();
        return $user['language'];
    }

    public static function isNewUser($userName)
    {
        $user = (new \yii\db\Query())
            ->from('user')
            ->where(['username' => $userName])
            ->one();
        if($user){
            $nowTimestamp = Yii::$app->formatter->asTimestamp(date("Y-m-d H:i:s"));
            $created = $user['created_at'];
            if($nowTimestamp - $created < 5){
                return true;
            }
        }

        return false;
    }

    public static function isBlocked($userName)
    {
        $user = (new \yii\db\Query())
            ->from('user')
            ->where(['username' => $userName])
            ->one();
        return $user['isBlocked'];
    }

    public static function getUserMoneyByUsername($userName)
    {
        $user = (new \yii\db\Query())
            ->from('user')
            ->where(['username' => $userName])
            ->one();
        $money = $user['money'];
        $currency = "EUR";

        if ($user['language'] == "BA") {
            $currency = "KM";
        }

        return $money . " " . $currency;
    }
}

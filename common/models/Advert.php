<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "advert".
 *
 * @property integer $id
 * @property string $position
 * @property integer $start_advert
 * @property integer $end_advert
 * @property integer $number_of_days
 * @property integer $created_at
 * @property integer $isPublished
 * @property integer $number_of_positions
 * @property string $web_address
 * @property string $contact_email
 * @property string $contact_person
 * @property string $location
 * @property string $category
 * @property integer $type
 * @property integer $anonymously
 * @property integer $payment
 * @property integer $payment_status
 * @property string $description
 * @property integer $user_id
 * @property float $price
 */
class Advert extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'advert';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['position', 'start_advert', 'end_advert', 'number_of_days', 'created_at', 'number_of_positions', 'web_address', 'contact_email', 'location',
                'category', 'type', 'anonymously', 'payment', 'payment_status', 'user_id'], 'required'],
            [['number_of_days', 'created_at', 'isPublished', 'number_of_positions', 'type', 'anonymously', 'payment', 'user_id'], 'integer'],
            [['description'], 'string'],
            [['position', 'web_address', 'contact_email', 'contact_person', 'location', 'category'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'position' => 'Position',
            'start_advert' => 'Start Advert',
            'end_advert' => 'End Advert',
            'number_of_days' => 'Number of Days',
            'created_at' => 'Created At',
            'isPublished' => 'Is Published',
            'number_of_positions' => 'Number Of Positions',
            'web_address' => 'Web Address',
            'contact_email' => 'Contact Email',
            'contact_person' => 'Contact Person',
            'location' => 'Location',
            'category' => 'Category',
            'type' => 'Type',
            'anonymously' => 'Anonymously',
            'payment' => 'Payment',
            'payment_status' => 'Payment Status',
            'description' => 'Description',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        $images = AdvertImage::find()
            ->where(["advert_id" => $this->getId()])
            ->orderBy('sort_order DESC')
            ->all();
        return empty($images) ? null : $images;
    }

    public function getFirstImage() {
        $first = AdvertImage::find()
            ->where(['advert_id' => $this->getId()])
            ->orderBy('sort_order DESC')
            ->one();
        return $first;
    }

    public static function getCompanyByUserId($id)
    {
        $user = User::find()->where(["id" => $id])->one();
        return $user != null ? $user->company_name : "-";
    }

    public static function getImageByUserId($id)
    {

        $user = User::find()->where(["id" => $id])->one();
        return $user != null ? $user->image : null;
    }


}


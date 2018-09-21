<?php
namespace common\models;

use Yii;

class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName() { return 'orders'; }

    public function rules()
    {
        return [
            ['ch_email', 'email'],
            [['ch_full_name', 'ch_city', 'ch_country', 'ch_phone'], 'string', 'min' => 3, 'max' => 30],
            [['ch_address', 'ch_email', 'order_info'], 'string', 'min' => 3, 'max' => 100],
            [['ch_zip'], 'string', 'min' => 3, 'max' => 9],
            [['order_number'], 'string', 'min' => 1, 'max' => 40]
        ];
    }

    public function attributeLabels()
    {
        return [
            'ch_email' => 'Email',
            'ch_full_name' => 'Ime i prezime',
            'ch_city' => 'Grad',
            'ch_country' => 'Država',
            'ch_phone' => 'Telefon',
            'ch_address' => 'Adresa',
            'ch_zip' => 'Zip / Poštanski broj',
        ];
    }

}
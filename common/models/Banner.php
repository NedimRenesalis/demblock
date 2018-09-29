<?php

namespace common\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\web\UploadedFile;
use yii\helpers\Url;
use yii\web\AssetBundle;

/**
 * Class Banner
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $image
 * @property string $url
 * @property string $client
 * @property string $adspace
 * @property int $visit_count
 * @property string $created_at
 * @property string $updated_at
 * @property string $valid_from
 * @property string $valid_until
 * @property string $comment
 */
class Banner extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%banner}}';
    }

    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
                'ensureUnique' => true,
            ],
            [
                'class' => TimestampBehavior::className(),
                'value' => date('Y-m-d G:i:s'),
            ],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function upload()
    {
        if ($this->validate()) {
            $storagePath = realpath(Yii::$app->basePath) . '//../' . Yii::getAlias('@banner');
            if (!file_exists($storagePath) || !is_dir($storagePath)) {
                if (!@mkdir($storagePath, 0777, true)) {
                    throw new \Exception(\Yii::t('app', 'The images storage directory({path}) does not exists and cannot be created!'. $storagePath));
                }
            }

            $this->image->saveAs($storagePath . '/' . $this->slug . '.' . $this->image->extension);
            $this->image = Yii::getAlias('@banner') . '/' . $this->slug . '.' . $this->image->extension;
            return true;
        } 
        
        return false;
    }

    /**
     * @inheritdoc
     */
    public static function deleteImage($img)
    {
        unlink(realpath(Yii::$app->basePath) . '//../' . $img);
    }

    /**
     * @inheritdoc
     */
    public function isActive()
    {
        $now = time();

        if ($this->active !== 1) {
            return false;
        }

        $valid_from = strtotime($this->valid_from);
        $valid_until = strtotime($this->valid_until);

        return $valid_from <= $now && $valid_until >= $now;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'url'], 'required'],
            [['visit_count', 'active'], 'integer'],
            [['created_at', 'updated_at', 'valid_from', 'valid_until', 'slug'], 'safe'],
            [['comment'], 'string'],
            [['url'], 'url'],
            [['image'], 'safe'],
            [['image'], 'required', 'on'=> 'create'],
            [['image'], 'file', 'maxSize'=>'100000'],
            [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png,jpg,jpeg,gif', 'wrongExtension' => '{extensions} files only.'],
            [['title', 'slug', 'url', 'client', 'adspace'], 'string', 'max' => 255],
            [['title'], 'unique'],
            [['slug'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => \Yii::t('app', 'ID'),
            'title' => \Yii::t('app', 'Title'),
            'slug' => \Yii::t('app', 'Slug'),
            'image' => \Yii::t('app', 'Image'),
            'url' => \Yii::t('app', 'Url'),
            'client' => \Yii::t('app', 'Client'),
            'adspace' => \Yii::t('app', 'Adspace'),
            'visit_count' => \Yii::t('app', 'Visit Count'),
            'created_at' => \Yii::t('app', 'Created At'),
            'updated_at' => \Yii::t('app', 'Updated At'),
            'valid_from' => \Yii::t('app', 'Valid From'),
            'valid_until' => \Yii::t('app', 'Valid Until'),
            'comment' => \Yii::t('app', 'Comment'),
            'active' => \Yii::t('app', 'Active'),
        ];
    }
}

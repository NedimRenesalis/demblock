<?php

namespace frontend\models;

use Yii;
use yii\web\Response;
use yii\web\UploadedFile;

use app\yii\base\Event;
use yii\helpers\Url;

/**
 * Class CompanyImage
 * @package app\models
 */
class CompanyImage extends \common\models\CompanyImage
{
    /**
     * Image default width
     */
    CONST IMG_WIDTH = 2000;

    /**
     * Image default height
     */
    CONST IMG_HEIGHT = 2000;

    /**
     * @var
     */
    public $imagesGallery;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['image_path'], 'required'],
            [['sort', 'company_id', 'image_form_key'], 'safe'],
            ['imagesGallery', 'each', 'rule' => ['file', 'extensions' => 'png, jpg, jpeg']],
        ];
    }


    public function afterDelete()
    {
        $relativePath    = '/uploads/images/companies/' . (int)self::IMG_WIDTH . 'x' . (int)self::IMG_HEIGHT;
        $resizeBasePath        = \Yii::getAlias('@webroot' . $relativePath);
        $imagesPath = \Yii::getAlias('@webroot'. $this->image_path);
        $resizeImageName = basename($imagesPath);
        $resizeImagesPath = glob("$resizeBasePath/*$resizeImageName");
        foreach ($resizeImagesPath as $file) {
            unlink($file);
        }

        unlink($imagesPath);

        parent::afterDelete();
    }

    /**
     * @param $imagesGallery
     * @param $image_form_key
     * @param $adId
     * @param $sort
     * @return array
     * @throws \Exception
     */
    public function uploadImageByAjax($imagesGallery, $image_form_key, $adId, $sort)
    {
        if ((int)$adId === 0) { $adId = null; }

        /* set the output to json */
        response()->format = Response::FORMAT_JSON;

        $storagePath = Yii::getAlias('@webroot/uploads/images/companies');
        if (!file_exists($storagePath) || !is_dir($storagePath)) {
            if (!@mkdir($storagePath, 0777, true)) {
                throw new \Exception(t('app', 'The images storage directory({path}) does not exists and cannot be created!'. $storagePath));
            }
        }

        foreach ($imagesGallery as $imageGallery) {
            $sort++;

            $newGalleryImageName = $imageGallery->name;

            if(!$imageGallery->saveAs($storagePath . '/' . $newGalleryImageName)){
              throw new \Exception(getErrorMessageFromErrorCode($imagesGallery->error));
            }
            if (!is_file($storagePath . '/' . $newGalleryImageName)) {
              throw new \Exception(t('app', 'Cannot move the image into the correct storage folder!'));
            }

            $existing_file = $storagePath . '/' . $newGalleryImageName;
            $newGalleryImageName = substr(sha1(time()), 0, 6) . $newGalleryImageName;
            rename($existing_file, $storagePath . '/' . $newGalleryImageName);

            $model = new static();
            $model->image_path = '/uploads/images/companies/' . $newGalleryImageName;
            $model->company_id = $adId;
            $model->image_form_key = $image_form_key;
            $model->sort_order = $sort;

            $model->save();

            return [
                'initialPreview' => Url::base('') . $model->image_path,
                'initialPreviewConfig' => [
                    ['caption' => $model->image_path,
                    'key' => $model->image_id,
                    'url' => url(['/remove-photo'])
                    ]
                ]
            ];

        }
    }
}
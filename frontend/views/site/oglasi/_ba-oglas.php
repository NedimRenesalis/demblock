<?php
/**
 * Created by PhpStorm.
 * User: I7
 * Date: 20.4.2017
 * Time: 18:43
 */
use common\models\Advert;
use yii\helpers\Url;
use common\models\User;
use common\models\Apply;

$apply = false;
if (!Yii::$app->user->isGuest) {
    $user = User::find()->where(['username' => Yii::$app->user->identity->username])->one();
    if ($user != null) {
        $apply = Apply::find()->where(["user_id" => $user->id, "advert_id" => $model->id])->one();
    }
}

$start = '<p>';
$end = '</p>';
$ini = strpos(' ' . $model->description, $start);
if ($ini == 0) {
    $first = "";
} else {
    $ini += strlen($start);
    $len = strpos($model->description, $end, $ini) - $ini + 1;
    $first = substr($model->description, $ini - 1, $len);
}

$model->description = str_replace('<p>' . $first . '</p>', '', $model->description);

$ini = strpos($model->description, $start);
if ($ini == 0) {
    $second = "";
} else {
    $ini    += strlen($start);
    $len    = strpos($model->description, $end, $ini) - $ini;
    $second = substr($model->description, $ini, $len);
    $second = $second . " ...";
}

?>

<div class="section new-job">

    <div>
        <?php if ($model->anonymously): ?>
            <div >
                <img src="<?= Url::to('@web/css/images/for-client.png'); ?>" class="img-responsive logo-im">
            </div>
        <?php elseif (Advert::getImageByUserId($model->user_id)): ?>
            <div>
                <?php if($model->getFirstImage()): ?>
                <img src="<?php  echo $model->getFirstImage()->getAbsImage(); ?>" class="img-responsive logo-im">
                <?php else: ?>
                <img src="<?= Url::to('@web/' . Advert::getImageByUserId($model->user_id)); ?>" class="img-responsive logo-im">
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div>
                <img src="<?= Url::to('@web/css/images/big-logo.png'); ?>" class="img-responsive logo-im">
            </div>
        <?php endif; ?>
    </div>

    <div class="new-job-content">
        <div class="job-title">
            <a target="_blank"
               href="<?= Url::to(['oglas', "id" => $model->id]); ?>"><?= $model->position; ?></a>
        </div>

        <div class="job-employer-wrapper">
            <?php if ($model->anonymously): ?>
                <a href="#">Zaposljavanje.BA</a>
            <?php else: ?>
                <a target="_blank"
                    href="<?= Url::to(['poslodavac-profil', 'id' => $model->user_id]); ?>"><?= Advert::getCompanyByUserId($model->user_id); ?></a>
            <?php endif; ?>
        </div>
       
    </div>
</div>

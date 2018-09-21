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
    $ini += strlen($start);
    $len = strpos($model->description, $end, $ini) - $ini;
    $second = substr($model->description, $ini, $len);
    $second = $second . " ...";
}
?>

<div class="section new-job">

    <div class="col-lg-2 col-md-2 ">
        <?php if ($model->anonymously): ?>
            <div ">
                <img src="<?= Url::to('@web/css/images/for-client.png'); ?>" class="img-responsive logo-im">
            </div>
        <?php elseif (Advert::getImageByUserId($model->user_id)): ?>
            <div >
                <img src="<?= Url::to('@web/' . Advert::getImageByUserId($model->user_id)); ?>"
                     class="img-responsive logo-im">
            </div>
        <?php else: ?>
            <div >
                <img src="<?= Url::to('@web/css/images/big-logo.png'); ?>" class="img-responsive logo-im">
            </div>
        <?php endif; ?>
    </div>

    <div class="col-lg-10 col-md-10 ">

        <div class="job-title">
            <a target="_blank"
               href="<?= Url::to(['oglas', "id" => $model->id]); ?>"><?= $model->position; ?></a>
        </div>
<br>
        <div class="job-employer-wrapper">
<br>
            <div class="job-employer">

                <?php if ($model->anonymously): ?>
                    <a href="#">Zaposljavanje.BA</a>
                <?php else: ?>
                    <a target="_blank"
                       href="<?= Url::to(['poslodavac-profil', 'id' => $model->user_id]); ?>"><?= Advert::getCompanyByUserId($model->user_id); ?></a>
                <?php endif; ?>
<br>
<br>
            </div>
            <div class="job-location">
                <?= "&nbsp;·&nbsp; " . $model->location . ", " . Yii::$app->formatter->asDatetime($model->start_advert, 'dd.MM.yyyy') ?>
            </div>

        </div>


    </div>

<br>
</div>
<hr class="job-divider">

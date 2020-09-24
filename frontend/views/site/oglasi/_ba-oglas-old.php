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
if(!Yii::$app->user->isGuest){
    $user = User::find()->where(['username' => Yii::$app->user->identity->username])->one();
    if ($user != null) {
        $apply = Apply::find()->where(["user_id" => $user->id, "advert_id" => $model->id])->one();
    }
}

?>


<?php if ($model->type == 3): ?>

    <div class="normal">
        <div class="advert-header">

            <?php if ($model->anonymously): ?>
                <div class="company col-lg-3 col-md-6">
                    <div><b>Kompanija:</b></div>
                    <div>demblock.BA</div>
                </div>
            <?php else: ?>
                <div class="company col-lg-3 col-md-6">
                    <div><b>Kompanija:</b></div>
                    <div><a target="_blank"  href="poslodavac-profil/<?=$model->user_id; ?>"><?= Advert::getCompanyByUserId($model->user_id); ?></a></div>
                </div>
            <?php endif; ?>


            <div class="category col-lg-3 col-md-6">
                <div><b>Kategorija:</b></div>
                <div><?= $model->category; ?></div>
            </div>

            <div class="position col-lg-3 col-md-6">
                <div><b>Pozicija:</b></div>
                <div><?= $model->position; ?></div>
            </div>

        </div>
        <hr>
        <div class="advert-body">

            <?php if (!$model->anonymously && Advert::getImageByUserId($model->user_id)): ?>
                <div class="company col-lg-3 col-md-6">
                    <img src="<?= Advert::getImageByUserId($model->user_id); ?>" class="img-responsive logo-im">
                </div>
            <?php else: ?>
                <div class="company-logo col-lg-3 col-md-6">
                    <img src="<?= Url::to('@web/css/images/big-logo.png'); ?>" class="img-responsive logo-im">
                </div>
            <?php endif; ?>


            <div class="date col-lg-3 col-md-6">
                <div><b>Početak - kraj:</b></div>
                <div><?= Yii::$app->formatter->asDatetime($model->start_advert, 'dd.MM.yyyy'); ?></div>
                <div><?= Yii::$app->formatter->asDatetime($model->end_advert, 'dd.MM.yyyy'); ?></div>
            </div>

            <div class="number-of-positions col-lg-3 col-md-6">
                <div>
                    <br>
                    <?php if ($employee): ?>
                        <div class="btn  btn-info btn-warning btn-applied" <?php if (!$apply) echo 'style="display:none"'; ?>
                             data-applied-id="<?= $model->id; ?>">Product tagged
                        </div>
                        <div class="btn  btn-success btn-apply" <?php if ($apply) echo 'style="display:none"'; ?>
                             data-id="<?= $model->id; ?>">TAG PRODUCT
                        </div>
                    <?php endif; ?>
                </div>
                <br>
                <div>
                    <div data-id="<?= $model->id; ?>" class="btn  btn-success display-description">Prikaži
                        opis
                    </div>
                    <a target="_blank" href="<?= Url::to(['oglas', "id" => $model->id]); ?>"
                       class="active btn btn-info">
                        Otvori oglas</a>
                </div>
            </div>
        </div>
        <div class="advert-desc" data-desc-id="<?= $model->id; ?>">
            <div><?= $model->description; ?></div>
        </div>
    </div>

<?php else: ?>

    <div class="platinum-premium">
        <div class="advert-header">

            <?php if ($model->anonymously): ?>
                <div class="company col-lg-3 col-md-6">
                    <div><b>Kompanija:</b></div>
                    <div>demblock.BA</div>
                </div>
            <?php else: ?>
                <div class="company col-lg-3 col-md-6">
                    <div><b>Kompanija:</b></div>
                    <div><a target="_blank" href="poslodavac-profil/<?=$model->user_id; ?>"><?= Advert::getCompanyByUserId($model->user_id); ?></a></div>
                </div>
            <?php endif; ?>


            <div class="category col-lg-3 col-md-6">
                <div><b>Kategorija:</b></div>
                <div><?= $model->category; ?></div>
            </div>

            <div class="position col-lg-3 col-md-6">
                <div><b>Pozicija:</b></div>
                <div><?= $model->position; ?></div>
            </div>

        </div>
        <hr>
        <div class="advert-body">

            <?php if (!$model->anonymously && Advert::getImageByUserId($model->user_id)): ?>
                <div class="company col-lg-3 col-md-6">
                    <img src="<?= Advert::getImageByUserId($model->user_id); ?>" class="img-responsive logo-im">
                </div>
            <?php else: ?>
                <div class="company-logo col-lg-3 col-md-6">
                    <img src="<?= Url::to('@web/css/images/big-logo.png'); ?>" class="img-responsive logo-im">
                </div>
            <?php endif; ?>


            <div class="date col-lg-3 col-md-6">
                <div><b>Početak - kraj:</b></div>
                <div><?= Yii::$app->formatter->asDatetime($model->start_advert, 'dd.MM.yyyy'); ?></div>
                <div><?= Yii::$app->formatter->asDatetime($model->end_advert, 'dd.MM.yyyy'); ?></div>
            </div>

            <div class="number-of-positions col-lg-3 col-md-6">
                <div>
                    <br>
                    <?php if ($employee): ?>
                        <div class="btn  btn-info btn-warning btn-applied" <?php if (!$apply) echo 'style="display:none"'; ?>
                             data-applied-id="<?= $model->id; ?>">Product tagged
                        </div>
                        <div class="btn  btn-success btn-apply" <?php if ($apply) echo 'style="display:none"'; ?>
                             data-id="<?= $model->id; ?>">TAG PRODUC
                        </div>
                    <?php endif; ?>
                </div>
                <br>
                <div>
                    <div data-id="<?= $model->id; ?>" class="btn  btn-info display-description">Prikaži
                        opis
                    </div>
                    <a target="_blank" href="<?= Url::to(['oglas', "id" => $model->id]); ?>"
                       class="active btn btn-info">
                        Otvori oglas</a>
                </div>
            </div>
        </div>
        <div class="advert-desc" data-desc-id="<?= $model->id; ?>">
            <div><?= $model->description; ?></div>
        </div>
    </div>

<?php endif; ?>

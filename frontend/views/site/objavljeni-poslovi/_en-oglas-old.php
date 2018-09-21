<?php
/**
 * Created by PhpStorm.
 * User: I7
 * Date: 20.4.2017
 * Time: 18:43
 */
use common\models\Advert;
use yii\helpers\Url;

?>


<?php if ($model->type == 3): ?>

    <div class="normal">
        <div class="advert-header">

            <?php if ($model->anonymously): ?>
                <div class="company col-lg-3 col-md-6">
                    <div>Kompanija:</div>
                    <div>ZAPOŠLJAVANJE.BA</div>
                </div>
            <?php else: ?>
                <div class="company col-lg-3 col-md-6">
                    <div>Kompanija:</div>
                    <div><?= Advert::getCompanyByUserId($model->user_id); ?></div>
                </div>
            <?php endif; ?>


            <div class="category col-lg-3 col-md-6">
                <div>Kategorija:</div>
                <div><?= $model->category; ?></div>
            </div>

            <div class="position col-lg-3 col-md-6">
                <div>Pozicija:</div>
                <div><?= $model->position; ?></div>
            </div>

            <div class="number-of-positions col-lg-3 col-md-6">
                <div>Lokacija:</div>
                <div><?= $model->location; ?></div>
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
                <div>Početak - kraj:</div>
                <div><?= Yii::$app->formatter->asDatetime($model->start_advert, 'dd.MM.yyyy'); ?></div>
                <div><?= Yii::$app->formatter->asDatetime($model->end_advert, 'dd.MM.yyyy'); ?></div>
            </div>

            <div class="contact col-lg-3 col-md-6">
                <div>Kontakt:</div>
                <div><?= $model->contact_person; ?></div>
                <div><?= $model->contact_email; ?></div>
                <div><a href="<?= $model->web_address; ?>" target="_blank"><?= $model->web_address; ?></a></div>
            </div>

            <div class="number-of-positions col-lg-3 col-md-6">
                <div>
                    <br>
                </div>
                <br>
                <div>
                    <div data-id="<?= $model->id; ?>" class="btn  btn-success display-description">Prikaži
                        opis
                    </div>
                    <a target="_blank" href="<?= Url::to(['oglas', "id" => $model->id]); ?>"
                       class="active btn btn-info">
                        Job</a>
                </div>
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
                    <div>Kompanija:</div>
                    <div>ZAPOŠLJAVANJE.BA</div>
                </div>
            <?php else: ?>
                <div class="company col-lg-3 col-md-6">
                    <div>Kompanija:</div>
                    <div><?= Advert::getCompanyByUserId($model->user_id); ?></div>
                </div>
            <?php endif; ?>


            <div class="category col-lg-3 col-md-6">
                <div>Kategorija:</div>
                <div><?= $model->category; ?></div>
            </div>

            <div class="position col-lg-3 col-md-6">
                <div>Pozicija:</div>
                <div><?= $model->position; ?></div>
            </div>

            <div class="number-of-positions col-lg-3 col-md-6">
                <div>Lokacija:</div>
                <div><?= $model->location; ?></div>
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
                <div>Početak - kraj:</div>
                <div><?= Yii::$app->formatter->asDatetime($model->start_advert, 'dd.MM.yyyy'); ?></div>
                <div><?= Yii::$app->formatter->asDatetime($model->end_advert, 'dd.MM.yyyy'); ?></div>
            </div>

            <div class="contact col-lg-3 col-md-6">
                <div>Kontakt:</div>
                <div><?= $model->contact_person; ?></div>
                <div><?= $model->contact_email; ?></div>
                <div><a href="<?= $model->web_address; ?>" target="_blank"><?= $model->web_address; ?></a></div>
            </div>

            <div class="number-of-positions col-lg-3 col-md-6">
                <div>
                    <br>
                </div>
                <br>
                <div>
                    <div data-id="<?= $model->id; ?>" class="btn  btn-info display-description">Prikaži
                        opis
                    </div>
                    <a target="_blank" href="<?= Url::to(['oglas', "id" => $model->id]); ?>"
                       class="active btn btn-info">
                        Job</a>
                </div>
                </div>
            </div>
        </div>
        <div class="advert-desc" data-desc-id="<?= $model->id; ?>">
            <div><?= $model->description; ?></div>
        </div>
    </div>

<?php endif; ?>
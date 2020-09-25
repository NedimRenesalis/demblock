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


<?php if ($model->type == 1) : ?>

    <div class="platinum-homepage">


        <?php if ($model->anonymously) : ?>
            <div class="sponsored-advert">
                <img src="<?= Url::to('@web/css/images/for-client.png'); ?>" class="img-responsive logo-im logo-index">
            </div>
        <?php elseif ($model->getFirstImage()) : ?>
            <div class="sponsored-advert">
                <img src="<?= $model->getFirstImage()->getAbsImage(); ?>" class="img-responsive logo-im logo-index">
            </div>
        <?php else : ?>
            <div class="sponsored-advert">
                <img src="<?= Url::to('@web/css/images/big-logo.png'); ?>" class="img-responsive logo-im logo-index">
            </div>
        <?php endif; ?>

        <div class="">
            <h4><?php echo $model->position; ?></h4>
        </div>
        <div class="text-description">
            <span class="item-category"><i class="fas fa-list-alt" aria-hidden="true"></i> <?= $model->category; ?></span>
            <span class="item-subcategory"><i class="fas fa-angle-right" aria-hidden="true"></i> <?= $model->position; ?></span>
        </div>
        <br>

    </div>


<?php elseif ($model->type == 2) : ?>

    <div class="midi-homepage ">


        <?php if ($model->anonymously) : ?>
            <div class="sponsored-advert">
                <img src="<?= Url::to('@web/css/images/for-client.png'); ?>" class="img-responsive logo-im logo-index">
            </div>
        <?php elseif ($model->getFirstImage()) : ?>
            <div class="sponsored-advert">
                <img src="<?= $model->getFirstImage()->getAbsImage(); ?>" class="img-responsive logo-im logo-index">
            </div>
        <?php else : ?>
            <div class="sponsored-advert">
                <img src="<?= Url::to('@web/css/images/big-logo.png'); ?>" class="img-responsive logo-im logo-index">
            </div>
        <?php endif; ?>
        <div class="">
            <div><?= $model->position; ?></div>
        </div>
        <br>

    </div>

<?php endif; ?>
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


<?php if ($model->type == 1): ?>

    <div class="platinum-homepage">


      <?php if ($model->anonymously): ?>
          <div class="sponsored-advert">
              <img src="<?= Url::to('@web/css/images/for-client.png'); ?>" class="img-responsive logo-im logo-index">
          </div>
        <?php elseif ($model->getImages()): ?>
            <div class="sponsored-advert">
                <img src="<?= ($model->getImages()[0])->getAbsImage(); ?>" class="img-responsive logo-im logo-index">
            </div>
        <?php else: ?>
          <div class="sponsored-advert">
              <img src="<?= Url::to('@web/css/images/big-logo.png'); ?>" class="img-responsive logo-im logo-index">
          </div>
      <?php endif; ?>

        <div class="">
       <b><div><?= $model->position; ?></div></b>
        </div>
    <br>
        <div class="promjenafonta">
            <div><u>Endet am:&nbsp<?= Yii::$app->formatter->asDatetime($model->end_advert, 'dd.MM.yyyy'); ?></u></div>
        </div>

        <div class="promjenafonta">
          <b>  <div><?= $model->location; ?></div> </b>
        </div>
<br>

    </div>


<?php elseif ($model->type == 2): ?>

    <div class="midi-homepage ">
      <?php if ($model->anonymously): ?>
          <div class="sponsored-advert">
              <img src="<?= Url::to('@web/css/images/for-client.png'); ?>" class="img-responsive logo-im logo-index">
          </div>
        <?php elseif ($model->getImages()): ?>
            <div class="sponsored-advert">
                <img src="<?= ($model->getImages()[0])->getAbsImage(); ?>" class="img-responsive logo-im logo-index">
            </div>
        <?php else: ?>
          <div class="sponsored-advert">
              <img src="<?= Url::to('@web/css/images/big-logo.png'); ?>" class="img-responsive logo-im logo-index">
          </div>
      <?php endif; ?>

        <div class="">
          <b><div><?= $model->position; ?></div></b>
        </div>
<br>
        <div class="promjenafonta">
            <div><u>Endet am:&nbsp<?= Yii::$app->formatter->asDatetime($model->end_advert, 'dd.MM.yyyy'); ?></u></div>
        </div>

        <div class="promjenafonta">
        <b>    <div><?= $model->location; ?></div> </b>
        </div>

<br>
    </div>

<?php endif; ?>

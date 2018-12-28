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

$this->title = 'Zapošljavanje';
$apply = false;
if (!Yii::$app->user->isGuest) {
    $user = User::find()->where(['username' => Yii::$app->user->identity->username])->one();
    if ($user != null) {
        $apply = Apply::find()->where(["user_id" => $user->id, "advert_id" => $model->id])->one();
    }
}

?>


<div class="section text-justify">
    <div class="container">
        <div class="row">
            <?php if ($model->type == 3): ?>
            <div class="normal">

                <div class="advert-header"> 
                    <div>
                        <?php if ($model->anonymously): ?>
                            <div class="col col-lg-1.5 col-md-6" style="min-width: 400px;">
                                <img src="<?= Url::to('@web/css/images/for-client.png'); ?>"
                                     class="img-responsive logo-im">
                            </div>
                            <?php elseif (!empty($images)): ?>
                                <div class=" col-lg-1.5 col-md-6">
                                    <?php
                                        echo dosamigos\gallery\Carousel::widget([
                                            'items' => $images,
                                            'json' => true,
                                            'clientOptions' => [
                                                'displayClass' => 'blueimp-gallery-display photo-ad-slider'
                                            ]
                                        ]);
                                    ?>
                                </div>
                            <?php else: ?>
                            <div class=" col-lg-1.5 col-md-6">
                                <img src="<?= Url::to('@web/css/images/big-logo.png'); ?>"
                                     class="img-responsive logo-im">
                            </div>
                        <?php endif; ?>
                    </div>

                </div>


                <br>
                <div class="advert-body">
                    <?php if ($model->anonymously): ?>
                        <div class="company col-lg-1.5 col-md-6">
                            <div>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="company col-lg-1.5 col-md-6">

                            <div><b>COMPANY PROFILE</b>
                                <a target="_blank"
                                   href="<?= Url::to(['poslodavac-profil', 'id' => $model->user_id]); ?>"><?= Advert::getCompanyByUserId($model->user_id); ?></a>
                                <br>

                            </div>
                            
                        </div>
                    <?php endif; ?>

                    <br>
                    <div class="category col-lg-1.5 col-md-6">
                        <div><b>PRODUCT  CATEGORY</b>&nbsp
                            <?= $model->category; ?></div>
                    </div>

                    <div class="position col-lg-1.5 col-md-6">
                        <div><b>SUBCATEGORY</b>&nbsp
                            <?= $model->position; ?></div>
                    </div>

                    <div class="number-of-positions col-lg-1.5 col-md-6">
                        <div><b>HIPPING FROM</b>&nbsp
                            <?= $model->location; ?></div>
                    </div>
                    <br>
                    <br>
                    <div class="date col-lg-1.5 col-md-6">
                        <div><b>AD VALID FROM - TO</b></div>
                        <div><?= Yii::$app->formatter->asDatetime($model->start_advert, 'dd.MM.yyyy'); ?>&nbsp - &nbsp
                            <?= Yii::$app->formatter->asDatetime($model->end_advert, 'dd.MM.yyyy'); ?></div>
                    </div>
                    <br>
                    <br>
                    <div class="contact col-lg-1.5 col-md-6">
                        <?php if (strpos($model->web_address, 'http') !== false) : ?>
                            <div><a href="<?= $model->web_address; ?>" target="_blank"><?= $model->web_address; ?></a>
                            </div>
                        <?php else : ?>
                            <div><a href="http://<?= $model->web_address; ?>"
                                    target="_blank"><?= $model->web_address; ?></a></div>
                        <?php endif; ?>
                    </div>

                </div>


                <br>
                <center>
                    <div class="number-of-positions col-lg-1.5 col-md-6">
                        <div>
                            <br>
                            <?php if ($employee): ?>
                                <div class="btn  btn-info btn-warning btn-applied" <?php if (!$apply) echo 'style="display:none"'; ?>
                                     data-applied-id="<?= $model->id; ?>">Product tagged
                                </div>
                                    <a class="btn btn-primary btn-apply" href="<?= Url::to(['message/compose', 'to' => $model->user_id,
                                                                    'answers' => null, 'context'=> null, 'add_to_recipient_list' => false, 'fromArticle' => true, 'articleId' => $model->Id
                                    ]); ?>">CONTACT SUPPLIER</a>
                                    <div class="btn  btn-success btn-apply" <?php if ($apply) echo 'style="display:none"'; ?>
                                        data-id="<?= $model->id; ?>">TAG PRODUCT
                                </div>
                            <?php endif; ?>
                        </div>
                </center>
                <hr>
                <br>


                <br>
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
                <div class="w3-container">
                    <div class="w3-left-align">
                        <div data-desc-id="<?= $model->id; ?>">
                            <div style="padding: 2px 60px; line-height: 1.7;"><?= $model->description; ?></div>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
            <br>

        </div>
    </div>
</div>
<br>





<?php else: ?>

    <div>
        <div class="advert-body">
            <div class="advert-header" >

                <div class="col-lg-1.5 col-md-6" style="min-width: 400px;">
                    <?php if ($model->anonymously): ?>
                        <img src="<?= Url::to('@web/css/images/for-client.png'); ?>" class="img-responsive logo-im">
                    <?php elseif (!empty($images)): ?>
                        <?php
                            echo dosamigos\gallery\Carousel::widget([
                                'items' => $images,
                                'json' => true,
                                'clientOptions' => [
                                    'displayClass' => 'blueimp-gallery-display photo-ad-slider'
                                ]
                            ]);
                        ?>
                    <?php else: ?>
                        <img src="<?= Url::to('@web/css/images/big-logo.png'); ?>" class="img-responsive logo-im">
                    <?php endif; ?>
                </div>

                <div class="advert-header-body col-lg-1.5 col-md-6">

                    <?php if ($model->anonymously): ?>
                        <div class="company">
                            <div>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="table-field">
                          <b><span class="title">COMPANY PROFILE</span></b>
                              <a target="_blank"
                              style="margin-left: 11px;" 
                                 href="<?= Url::to(['poslodavac-profil', 'id' => $model->user_id]); ?>"><?= Advert::getCompanyByUserId($model->user_id); ?></a>


                          </div>
                    <?php endif; ?>

                    <div class="table-field">
                        <b><span class="title">PRODUCT  CATEGORY</span></b>&nbsp
                            <?= $model->category; ?>
                    </div>
                    <div class="table-field">
                        <b><span class="title">SUBCATEGORY</span></b>&nbsp
                            <?= $model->position; ?>
                    </div>
                    <div class="table-field">
                        <b><span class="title">SHIPPING FROM</span></b>&nbsp
                            <?= $model->location; ?>
                    </div>

                </div>


            </div>

            <!-- END HEADER -->

            <div class="advert-sec">
              <div class="sec">
                  <div><b>AD VALID FROM - TO</b></div>
                  <div><?= Yii::$app->formatter->asDatetime($model->start_advert, 'dd.MM.yyyy'); ?>&nbsp - &nbsp
                      <?= Yii::$app->formatter->asDatetime($model->end_advert, 'dd.MM.yyyy'); ?></div>
              </div>
              <div class="sec">
                  <?php if (strpos($model->web_address, 'http') !== false) : ?>
                      <div><a href="<?= $model->web_address; ?>" target="_blank"><?= $model->web_address; ?></a></div>
                  <?php else : ?>
                      <div><a href="http://<?= $model->web_address; ?>"target="_blank"><?= $model->web_address; ?></a>
                      </div>
                  <?php endif; ?>
              </div>
                <div class="sec">
                    <?php if ($employee): ?>
                        <div class="btn  btn-info btn-warning btn-applied" <?php if (!$apply) echo 'style="display:none"'; ?>
                             data-applied-id="<?= $model->id; ?>">Product tagged
                        </div>
                        <div>
                            <a class="btn btn-primary btn-apply" href="<?= Url::to(['message/compose', 'to' => $model->user_id,
                                                                    'answers' => null, 'context'=> null, 'add_to_recipient_list' => false, 'fromArticle' => true, 'articleId' => $model->Id
                            ]); ?>">CONTACT SUPPLIER</a>
                            <div class="btn  btn-success btn-apply" <?php if ($apply) echo 'style="display:none"'; ?>
                                data-id="<?= $model->id; ?>">TAG PRODUCT
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="btn  btn-success btn-apply-disabled">TAG PRODUCT</div>
                    <?php endif; ?>
                </div>
            </div>

            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
            <div class="w3-container">
                <div class="w3-left-align">
                    <div data-desc-id="<?= $model->id; ?>">
                        <div style="line-height: 1.9; padding: 0 60px;"><?= $model->description; ?></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <br>

<?php endif; ?>

<div class="not-registered-wrapper advert-application" style="display: none">
    <div class="not-registered">
        <div class="close-img">
            <img class="image-responsive" src="<?= Url::to('@web/css/images/close.png') ?>">
        </div>
        IN ORDER TO TAG PRODUCT SIGN IN TO YOUR PROFILE <br>
        <a href="<?= Url::to(['prijava']); ?>">SIGN IN</a><br><br>
        IF YOU DONT HAVE A PROFILE - REGISTER<br>
        <a href="<?= Url::to(['registracija-posloprimac']); ?>">REGISTER</a>
    </div>
</div>

<script>

    $(document).ready(function () {
        $(".btn-apply").on("click", function () {
            var id = $(this).data('id');
            apply(id);
        });

        $(".btn-apply-disabled").on("click", function () {
            $(".not-registered-wrapper").show();
            window.scrollTo(0,0);
        });

        $(".close-img").on("click", function () {
            $(".not-registered-wrapper").hide();
        });
    });

    function apply(id) {
        $.ajax({
            type: "GET",
            url: "<?php echo Yii::$app->getUrlManager()->createUrl('apply'); ?>",
            data: {id: id},
            success: function (response) {
                if (response == 1) {
                    $(".btn-apply[data-id=" + id + "]").hide();
                    $(".btn-applied[data-applied-id=" + id + "]").show();
                }
            },
            error: function (exception) {
                alert(exception);
            }
        })
        ;
    }


</script>


<br>


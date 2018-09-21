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

?>


<div class="section text-justify">
    <div class="container">
        <div class="row">
            <?php if ($model->type == 3): ?>

            <div class="normal">
                <div class="advert-header">

                    <center>
                        <?php if ($model->anonymously): ?>
                            <div class=" col-lg-1.5 col-md-6">
                                <img src="<?= Url::to('@web/css/images/for-client.png'); ?>"
                                     class="img-responsive logo-im">
                            </div>
                        <?php elseif (Advert::getImageByUserId($model->user_id)): ?>
                            <div class=" col-lg-1.5 col-md-6">
                                <img src="<?= Url::to('@web/' . Advert::getImageByUserId($model->user_id)); ?>"
                                     class="img-responsive logo-im">
                            </div>
                        <?php else: ?>
                            <div class=" col-lg-1.5 col-md-6">
                                <img src="<?= Url::to('@web/css/images/big-logo.png'); ?>"
                                     class="img-responsive logo-im">
                            </div>
                        <?php endif; ?>
                    </center>


                </div>

                <hr>

                <br>

                <div class="advert-body">
                    <?php if ($model->anonymously): ?>
                        <div class="company col-lg-1.5 col-md-6">
                            <div></div>
                        </div>
                    <?php else: ?>
                        <div class="company col-lg-1.5 col-md-6">
                            <div><b>Company profile:&nbsp</b><a target="_blank"
                                                                href="<?= Url::to(['poslodavac-profil', 'id' => $model->user_id]); ?>"><?= Advert::getCompanyByUserId($model->user_id); ?></a>
                            </div>
                        </div>
                    <?php endif; ?>

                    <br>
                    <div class="category col-lg-1.5 col-md-6">
                        <div><b>Category:</b>&nbsp<?= $model->category; ?></div>
                    </div>
                    <br>
                    <div class="position col-lg-1.5 col-md-6">
                        <div><b>Position:</b>&nbsp<?= $model->position; ?></div>
                    </div>
                    <br>
                    <div class="number-of-positions col-lg-1.5 col-md-6">
                        <div><b>Location:</b>&nbsp<?= $model->location; ?></div>
                    </div>
                    <br>


                    <div class="date col-lg-1.5 col-md-6">
                        <div><b>Start - end:</b></div>
                        <div><?= Yii::$app->formatter->asDatetime($model->start_advert, 'dd.MM.yyyy'); ?>
                            <?= Yii::$app->formatter->asDatetime($model->end_advert, 'dd.MM.yyyy'); ?></div>
                    </div>
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

                    <div class="number-of-positions col-lg-1.5 col-md-6">
                        <div>
                            <br>
                            <?php if ($employee): ?>
                                <div class="btn  btn-info btn-warning btn-applied" <?php if (!$apply) echo 'style="display:none"'; ?>
                                     data-applied-id="<?= $model->id; ?>">Applied
                                </div>
                                <div class="btn  btn-success btn-apply" <?php if ($apply) echo 'style="display:none"'; ?>
                                     data-id="<?= $model->id; ?>">Apply
                                </div>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>

                <hr>
                <br>
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
                <div class="w3-container">
                    <div class="w3-left-align">

                        <div data-desc-id="<?= $model->id; ?>">
                            <div><?= $model->description; ?></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <?php else: ?>

        <div class="platinum-premium">
            <div class="advert-header">

                <center>
                    <?php if ($model->anonymously): ?>
                        <div class=" col-lg-1.5 col-md-6">
                            <img src="<?= Url::to('@web/css/images/for-client.png'); ?>" class="img-responsive logo-im">
                        </div>
                    <?php elseif (Advert::getImageByUserId($model->user_id)): ?>
                        <div class=" col-lg-1.5 col-md-6">
                            <img src="<?= Url::to('@web/' . Advert::getImageByUserId($model->user_id)); ?>"
                                 class="img-responsive logo-im">
                        </div>
                    <?php else: ?>
                        <div class=" col-lg-1.5 col-md-6">
                            <img src="<?= Url::to('@web/css/images/big-logo.png'); ?>" class="img-responsive logo-im">
                        </div>
                    <?php endif; ?>
                </center>


            </div>
            <hr>
            <div class="advert-body">
                <?php if ($model->anonymously): ?>
                    <div class="company col-lg-1.5 col-md-6">
                        <div></div>
                    </div>
                <?php else: ?>
                    <div class="company col-lg-1.5 col-md-6">
                        <div><b>Company profile:&nbsp</b><a target="_blank"
                                                            href="<?= Url::to(['poslodavac-profil', 'id' => $model->user_id]); ?>"><?= Advert::getCompanyByUserId($model->user_id); ?></a>
                        </div>
                    </div>
                <?php endif; ?>
                <br>

                <div class="category col-lg-1.5 col-md-6">
                    <div><b>Category:</b>&nbsp<?= $model->category; ?></div>
                </div>
                <br>
                <div class="position col-lg-1.5 col-md-6">
                    <div><b>Position:</b>&nbsp<?= $model->position; ?></div>
                </div>

                <div class="number-of-positions col-lg-1.5 col-md-6">
                    <div><b>Location:</b>&nbsp<?= $model->location; ?></div>
                </div>
                <br>
                <br>
                <div class="date col-lg-1.5 col-md-6">
                    <div><b>Start - end:</b></div>
                    <div><?= Yii::$app->formatter->asDatetime($model->start_advert, 'dd.MM.yyyy'); ?>
                        <?= Yii::$app->formatter->asDatetime($model->end_advert, 'dd.MM.yyyy'); ?></div>
                </div>

                <div class="contact col-lg-1.5 col-md-6">

                    <?php if (strpos($model->web_address, 'http') !== false) : ?>
                        <div><a href="<?= $model->web_address; ?>" target="_blank"><?= $model->web_address; ?></a></div>
                    <?php else : ?>
                        <div><a href="http://<?= $model->web_address; ?>"
                                target="_blank"><?= $model->web_address; ?></a></div>
                    <?php endif; ?>
                </div>

                <div class="number-of-positions col-lg-1.5 col-md-6">
                    <div>
                        <br>
                        <?php if ($employee): ?>
                            <div class="btn  btn-info btn-warning btn-applied" <?php if (!$apply) echo 'style="display:none"'; ?>
                                 data-applied-id="<?= $model->id; ?>">Applied
                            </div>
                            <div class="btn  btn-success btn-apply" <?php if ($apply) echo 'style="display:none"'; ?>
                                 data-id="<?= $model->id; ?>">Apply
                            </div>
                        <?php else: ?>
                            <div class="btn  btn-success btn-apply-disabled">Apply</div>
                        <?php endif; ?>
                    </div>

                </div>
            </div>

            <hr>
            <br>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
            <div class="w3-container">
                <div class="w3-left-align">

                    <div data-desc-id="<?= $model->id; ?>">
                        <div><?= $model->description; ?></div>
                    </div>
                </div>
            </div>

            <?php endif; ?>
        </div>
    </div>
</div>

<div class="not-registered-wrapper advert-application" style="display: none">
    <div class="not-registered">
        <div class="close-img">
            <img class="image-responsive" src="<?= Url::to('@web/css/images/close.png') ?>">
        </div>
        In order to apply, please <br>
        <a href="<?= Url::to(['prijava']); ?>">SIGN IN</a><br><br>
        If don`t have an account, please <br>
        <a href="<?= Url::to(['registracija-posloprimac']); ?>">REGISTER AS AN EMPLOYEE</a>
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
<center>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- 7 -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-5242454575053212"
     data-ad-slot="8305373463"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</center>

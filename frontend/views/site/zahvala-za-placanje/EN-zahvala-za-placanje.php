
<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = 'Zapošljavanje';
?>

<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img src="<?= Url::to('@web/css/images/password-reset-left.jpg'); ?>" class="img-responsive">
            </div>
            <div class="col-md-4">
                <p class="text-center">Thank you.
                <br>
                <br><b>Your job posting is already online and cannot be modified any more.</b>
                <br>
<br>The invoice will be sent to your email inbox in a couple of seconds.
<br>
                <br>To see which candidates have applied to your job posting, go to the "Jobs" section in the upper right corner.

                </p>
            </div>
            <div class="col-md-4">
                <img src="<?= Url::to('@web/css/images/password-reset-right.jpg'); ?>" class="img-responsive">
            </div>
        </div>
    </div>
</div>

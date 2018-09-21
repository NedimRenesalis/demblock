
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
                <p class="text-center">Link za obnovu lozinke je poslan na Vaš email.</p>
            </div>
            <div class="col-md-4">
                <img src="<?= Url::to('@web/css/images/password-reset-right.jpg'); ?>" class="img-responsive">
            </div>
        </div>
    </div>
</div>
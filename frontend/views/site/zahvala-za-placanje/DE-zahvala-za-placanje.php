
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
                <p class="text-center">Vielen Dank für Ihr Vertrauen.
                  <br>
                  <br><b>Ihre Stellenanzeige ist bereits online und kann nicht mehr geändert werden.</b>
                  <br>
                  <br>Die Rechnung werden Sie in einigen Sekunden automatisch per eMail bekommen.
                  <br>
                  <br>Wenn Sie überprüfen wollen, welche Kandidaten sich für die ausgeschriebene Stelle beworben haben, gehen Sie auf "Jobs" in der oberen rechten Ecke.

                </p>
            </div>
            <div class="col-md-4">
                <img src="<?= Url::to('@web/css/images/password-reset-right.jpg'); ?>" class="img-responsive">
            </div>
        </div>
    </div>
</div>

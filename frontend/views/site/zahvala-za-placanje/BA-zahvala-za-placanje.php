
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
                <p class="text-center">Hvala
                <br>
                <br><b>Vaš oglas je već online i isti više nije moguće mjenjati.</b>
<br>
                <br>Račun ćete za nekoliko sekundi automatski dobiti putem email-a.
                <br>
                <br>Ako želite provjeriti koji su kandidati aplicirali na objavljeni oglas, kliknite u desnom gornjem čošku na "Poslovi" i onda na "Aplicirali".
              </p>
            </div>
            <div class="col-md-4">
                <img src="<?= Url::to('@web/css/images/password-reset-right.jpg'); ?>" class="img-responsive">
            </div>
        </div>
    </div>
</div>

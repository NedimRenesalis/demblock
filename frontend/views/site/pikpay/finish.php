<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = 'Pikpay rezultat';
?>
<div id="pik-pay-messages"> <?php foreach (Yii::$app->session->getAllFlashes() as $key => $message) { echo '<div class="alert alert-' . $key . '">' . $message . '</div>'; } ?>  </div>
<br><div style="text-align: center;"><a style="text-align: center;" href="/" class="btn btn-info">Vrati se na početnu stranicu - Gehen Sie zur Startseite zurück - Go back to the landing page.</a></div>

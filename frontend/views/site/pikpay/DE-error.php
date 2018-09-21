<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = 'Greška';
?>

  <div class="alert alert-danger">Es ist ein Fehler aufgetreten. <?php echo (isset($_GET['error'])) ? $_GET['error'] : ''; ?> <a href="/">Zurück zur Startseite.</a></div>

<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = 'Greška';
?>
    
  <div class="alert alert-danger">Dogodila se greška prilikom plaćanja. <?php echo (isset($_GET['error'])) ? $_GET['error'] : ''; ?> <a href="/">Vrati se na početnu stranicu.</a></div>

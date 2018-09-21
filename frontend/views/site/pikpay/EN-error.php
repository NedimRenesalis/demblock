<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = 'Greška';
?>

  <div class="alert alert-danger">An error occurred.  <?php echo (isset($_GET['error'])) ? $_GET['error'] : ''; ?> <a href="/">Go back to previous page.</a></div>

<?php
/**
 * Created by PhpStorm.
 * User: I7
 * Date: 30.5.2017
 * Time: 18:43
 */
$this->title="Zapošljavanje";
?>

<br>
<br>
<div class="platinum-premium">

<div class="container profile-wrapper">


    <div class="col-lg-12 employer-banner">
        <?php if ($model->banner != null): ?>
            <div class="form-group">
                <div class=" text-center">
                    <img class="image-responsive" src="<?= "../" . $model->banner; ?>">
                </div>
            </div>
        <?php endif; ?>
    </div>
<br>
<hr>
    <div class="col-lg-12 employer-logo">
        <?php if ($model->image != null): ?>
            <div class="form-group">
                <div class=" text-center">
                    <img class="image-responsive" src="<?= "../".$model->image ;?>">
                </div>
            </div>
        <?php endif; ?>
    </div>

<hr>
    <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
   <div class="w3-container">
   <div class="w3-left-align">



    <div class="col-lg-12 employer-banner">
        <?= $model->company_description; ?>
    </div>

  </div>
  </div>


    <br>
    <hr>
    <br>
<center>
    <div class="col-lg-12 employer-description">

        <b><?= $model->company_name; ?></b>

<br>

<br>

        <b>Firmenanschrift: </b><?= $model->address; ?><br>
        <b>Postleitzahl: </b><?= $model->zip_code; ?><br>
        <br>

        <br>  
    </div>
</center>
</div>
</div>

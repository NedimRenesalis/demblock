<?php
/**
 * Created by PhpStorm.
 * User: I7
 * Date: 30.5.2017
 * Time: 18:43
 */
$this->title = "Zapošljavanje";
?>
<br>
<br>
<div class="platinum-premium">
<center>
<div class="section new-job">

    <div class="col-lg-12 employee-title">

    <b> <?= $model->first_name . " " . $model->last_name; ?> </b>
    </div>

    <div class="col-lg-12 employee-description">


        <b>Year of birth: </b><?= $model->year_of_birth; ?><br>
        <b>Gender: </b><?= $model->gender; ?><br>
<br>
        <b>Zip Code: </b><?= $model->zip_code; ?><br>
<br>
        <b>Education Level: </b><?= $model->education_level; ?><br>
        <b>Current Career Level: </b><?= $model->career_level; ?><br>
        <b>Additional Experience: </b><?= $model->additional_experience; ?><br>
<br>
        <b>Email address: </b><?= $model->email; ?><br>
        <b>Phone number: </b><?= $model->phone; ?><br>
    </div>
    </center>
  </div>
  <br>
  <br>
</div>
<br>

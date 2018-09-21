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

<div class="section new-job">

    <div class="col-lg-12 employee-title">

    </div>

<center>
    <div class="col-lg-12 employee-description">
   <b><?= $model->first_name . " " . $model->last_name ; ?></b>
   <br>
   <br>

        <b>Godina rođenja: </b><?= $model->year_of_birth; ?><br>
        <b>Pol: </b><?= $model->gender; ?><br>
        <br>
        <b>Poštanski broj: </b><?= $model->zip_code; ?><br>
<br>
        <b>Struka: </b><?= $model->education_level; ?><br>
        <b>Zanimanje: </b><?= $model->career_level; ?><br>
        <b>Dodatne kvalifikacije: </b><?= $model->additional_experience; ?><br>

        <b>Željeni posao: </b><?= $model->job; ?><br>
  <b>Željena lokacija: </b><?= $model->location; ?><br>
<br>
<b>Kontakt telefon: </b><?= $model->phone; ?><br>
<b>Email adresa: </b><?= $model->email; ?><br>
<br>
  </div>
</center>

    </div>
    <br>
    <br>
</div>
<br>

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
<center>
    <div class="col-lg-12 employee-title">

        <b> <?= $model->first_name . " " . $model->last_name ; ?> </b>
    </div>

    <div class="col-lg-12 employee-description">


        <b>Geburtsjahr: </b><?= $model->year_of_birth; ?><br>
        <b>Geschlecht: </b><?= $model->gender; ?><br>
        <br>
        <b>Postleitzahl: </b><?= $model->zip_code; ?><br>
        <br>
        <b>Ausbildungsart: </b><?= $model->education_level; ?><br>
        <b>Gewünschte Anstellungsart: </b><?= $model->career_level; ?><br>
        <b>Letzte Berufserfahrung: </b><?= $model->additional_experience; ?><br>
        <br>
        <b>Email: </b><?= $model->email; ?><br>
        <b>Telefonnummer: </b><?= $model->phone; ?><br>

    </div>
    </center>
  </div>
  <br>
  <br>
</div>
<br>

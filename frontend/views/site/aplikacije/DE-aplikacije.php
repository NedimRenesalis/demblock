<?php
use yii\helpers\Url;

$this->title = 'Zapošljavanje';
?>

<?php if ($users): ?>
    <div class="section ">

        <div class="container">

              <div class="platinum-premium">
            <?php foreach ($users as $user): ?>
                <div class=" user-cv">
                    <div class="row">
                    <center>        <div class="col-lg-4 col-md-4 col-sm-4">
                            <b>Vorname:</b> <?= $user->first_name; ?>
                        </div>  </center>
                <center>           <div class="col-lg-4  col-md-4 col-sm-4">
                          <b>Nachname:</b> <?= $user->last_name; ?>
                        </div> </center>

                <center>            <div class="col-lg-4  col-md-4 col-sm-4">
                             <b>Geburtsjahr:</b><?= $user->year_of_birth; ?>
                        </div></center>



                    </div>
                    <br>
                    <div class="row">

<br>


                        <div class="col-lg-12 col-md-12 col-sm-4">

                            <?php if ($user->image): ?>
                      <center>           <a href="<?= Url::to(['download-cv', "id"=> $user->id]); ?>" class="active btn btn-success">
                                CV wurde hochgeladen</a></center>
                                <?php else: ?>
                                    CV wurde nicht hochgeladen.
                                <?php endif; ?>
<br>

                    <center>               <a target="_blank"  href="<?= Url::to(['posloprimac-profil', "id" => $user->id]); ?>"
                                   class="active btn btn-info">
                                    Arbeitnehmerprofil ansehen</a></center>


                        </div>
                    </div>
                </div>
                    </div>
                <br>
                <div class="platinum-premium">
            <?php endforeach; ?>
        </div>
      </div>
  </div>

    </div>
<?php else: ?>
    <div class="section">
        <div class="container">
      <center> <b>      Niemand hat sich bis jetzt um die Stelle beworben. </b> </center>
        </div>
    </div>
<?php endif; ?>

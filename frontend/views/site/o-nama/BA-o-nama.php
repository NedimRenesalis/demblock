<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = 'demblock';
?>

<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img src="<?= Url::to('@web/css/images/about-us.jpg'); ?>" class="img-responsive">
            </div>
            <div class="col-md-4">
                <br>
                <p class="text-justify">Zaposljavanje.ba je inovativni internet portal sa sjedištem u Sarajevu
                    za oglašavanje radnih mjesta, unapređenje karijere, kao i razvoj ljudskih
                    resursa.
                    <br>
                    <br>
                    <strong>Pored klasične usluge spajanja posloprimaca i poslodavaca sa područija
                        BiH, zaposljavanje.ba nudi posebne mogućnosti poslodavcima iz inostranstva
                        da stupe u kontakt sa posloprimcima iz naše zemlje, koji žele započeti
                        karijeru u nekoj drugoj zemlji.</strong>
                    <br>
                    <br>U ponudi imamo i veoma pristupačne cijene oglašavanja čak i za male privrednike, koji su nerijetko u potražnji za kvalitetnim kadrom, a kojima su dosadašnje opcije  internet oglasa za posao bile preskupe.
                    <br>
                    <br>Mi smo jedini internet portal za radna mjesta u regionu koji nudi oglase
                    na tri jezika.</p>
            </div>
            <div class="col-md-4">
                <img src="<?= Url::to('@web/css/images/about-us2.jpg'); ?>" class="img-responsive">
            </div>
        </div>
    </div>
</div>

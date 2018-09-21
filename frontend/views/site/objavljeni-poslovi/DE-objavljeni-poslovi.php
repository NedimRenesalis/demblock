<?php
use yii\widgets\ListView;
use yii\helpers\Url;
$this->title = 'Zapošljavanje';
?>

<div class="section text-justify">
    <div class="container">
        <div class="row">
            <div class="a-search-button col-lg-4 col-md-4 col-sm-4  col-xs-12">
                <a class="active btn btn-primary" href="<?= Url::to('objavljeni-poslovi'); ?>">Alle Stellenanzeigen</a>
            </div>
            <div class="a-search-button col-lg-4 col-md-4  col-sm-4 col-xs-12">
                <a class="active btn btn-primary"
                   href="<?= Url::to(['objavljeni-poslovi', 'type' => 'active']); ?>">Aktive Stellenanzeigen</a>
            </div>
            <div class="a-search-button col-lg-4 col-md-4  col-sm-4 col-xs-12">
                <a class="active btn btn-primary "
                   href="<?= Url::to(['objavljeni-poslovi', 'type' => 'inactive']); ?>">Inaktive Stellenanzeigen</a>
            </div>
        </div>
    </div>
</div>

<div class="section text-justify">
    <div class="container">
        <div class="row">
            <?php if ($dataProvider->totalCount > 0): ?>
            <?php echo ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_de-oglas',
                'layout' => "{summary}\n{items}\n<div class='text-center'>{pager}</div>",
                'viewParams' => [
                    'fullView' => true,
                    'context' => 'main-page',
                    'employee' => $employee
                ],
            ]);
            ?>

            <?php else: ?>

        <center>      <b>          <?= "Leer."; ?> </b> </center>      

            <?php endif; ?>
        </div>
    </div>
</div>

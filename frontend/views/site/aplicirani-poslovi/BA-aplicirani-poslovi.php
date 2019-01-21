<?php
use yii\widgets\ListView;
use yii\helpers\Url;

$this->title = 'demblock';
?>

<div class="section text-justify">
    <div class="container-fluid" style="margin-top: 30px;">
        <div class="row">

            <?php if ($dataProvider->totalCount > 0): ?>

                <?php echo ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemView' => '_ba-oglas',
                    'layout' => "{summary}\n{items}\n<div class='text-center'>{pager}</div>",
                    'viewParams' => [
                        'fullView' => true,
                        'context' => 'main-page'
                    ],
                ]);
                ?>

            <?php else: ?>
<br><br><br><br><br><br><br><br><br>
        <b>     <center>   <?= "None product has been tagged as favourite yet"; ?></center></b>

            <?php endif; ?>
        </div>
    </div>
</div>
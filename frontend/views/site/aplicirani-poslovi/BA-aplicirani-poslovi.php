<?php
use yii\widgets\ListView;
use yii\helpers\Url;

$this->title = 'Zapošljavanje';
?>

<div class="section text-justify">
    <div class="container">
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
        <b>     <center>   <?= "None of your products has been tagged as favourite yet"; ?></center></b>

            <?php endif; ?>
        </div>
    </div>
</div>
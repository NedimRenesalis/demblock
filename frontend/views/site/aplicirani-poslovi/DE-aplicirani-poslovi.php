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
                'itemView' => '_de-oglas',
                'layout' => "{summary}\n{items}\n<div class='text-center'>{pager}</div>",
                'viewParams' => [
                    'fullView' => true,
                    'context' => 'main-page'
                ],
            ]);
            ?>
            <?php else: ?>

                <?= "Leer."; ?>

            <?php endif; ?>
        </div>
    </div>
</div>
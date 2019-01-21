<?php
use yii\widgets\ListView;
use yii\helpers\Url;
$this->title = 'demblock';
?>
<br>
<br>
<div class="section text-justify">
    <div class="container">
        <div class="row tabs">
            <div class="tab-item is-active">
                <a
                    href="<?= Url::to('objavljeni-poslovi'); ?>">All listed and delisted products</a>
            </div>
            
            <div class="tab-item">
                <a
                   href="<?= Url::to(['objavljeni-poslovi', 'type' => 'active']); ?>">All listed products</a>
            </div>
            
            <div class="tab-item">
                <a
                   href="<?= Url::to(['objavljeni-poslovi', 'type' => 'inactive']); ?>">All delisted products</a>
            </div>
            
        </div>
    </div>
</div>

<div class="section text-justify">
    <div class="container-fluid">
        <div class="row">
            <?php if ($dataProvider->totalCount > 0): ?>
            <?php echo ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_ba-oglas',
                'layout' => "{summary}\n{items}\n<div class='text-center'>{pager}</div>",
                'viewParams' => [
                    'fullView' => true,
                    'context' => 'main-page',
                    'employee' => $employee
                ],
            ]);
            ?>
            
            <?php else: ?>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
          <center>      <b><?= "NOTHING FOUND"; ?></b><Br><br>Try another of the above tabs </center>

            <?php endif; ?>
        </div>
    </div>
</div>

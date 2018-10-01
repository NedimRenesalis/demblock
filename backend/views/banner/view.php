<?php
    use yii\helpers\Html;
    use yii\widgets\DetailView;

    $this->title = $banner->title;
    $this->params['breadcrumbs'][] = ['label' => \Yii::t('app', 'Banner'), 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="subscribers-header">
    <h1 class="box-title no-margin"><?=Html::encode($this->title)?></h1>
    <p>        
        <?= Html::a(\Yii::t('app', 'Update'), ['update', 'id' => $banner->slug], ['class' => 'btn btn-xs btn-success']) ?>
        <?= Html::a(\Yii::t('app', 'Delete'), ['delete', 'id' => $banner->slug], [
            'class' => 'btn btn-xs btn-danger',
            'data' => [
                'confirm' => \Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
</div>

<div class="box-body">
    <?= DetailView::widget([
        'model' => $banner,
        'attributes' => [
            'id',
            'title',
            'slug',
            'valid_from',
            'valid_until',
            'url:url',
            'visit_count',
            'image',
            'client',
            'adspace',
            'created_at',
            'updated_at',
            'comment:ntext',
        ],
    ]) ?>
</div>
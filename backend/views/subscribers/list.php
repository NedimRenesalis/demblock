<?php
    use yii\grid\GridView;
    use yii\helpers\Html;
    use yii\widgets\Pjax;

    $this->title = \Yii::t('app', 'Subscribers');
    $this->params['breadcrumbs'][] = $this->title;
?>

<div class="subscribers-header">
    <h1 class="box-title no-margin"><?=Html::encode($this->title)?></h1>
    <p>
        <?=Html::a(Html::tag('i', '', ['class' => 'fa fa-refresh fa-fw']) . \Yii::t('app', 'Refresh'), ['index'], ['class' => 'btn btn-success'])?>
    </p>
</div>

<div class="subscribers-index">
    <?php Pjax::begin([
        'enablePushState' => true,
    ]);?>
    <?=GridView::widget([
        'id' => 'subscribers',
        'tableOptions' => [
            'class' => 'table table-bordered table-hover table-striped',
        ],
        'options' => ['class' => 'table-responsive grid-view'],
        'dataProvider'  => $dataProvider,
        'filterModel'   => $searchModel,
        'columns' => [
            'email',
            'created_at',
            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => [
                    'style' => 'width:145px',
                    'class' => 'table-actions',
                ],
                'template' => '{delete}',
            ],
        ],
    ]);?>
    <?php Pjax::end();?>
</div>
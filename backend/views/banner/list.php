<?php
    use common\models\Banner;
    use yii\grid\GridView;
    use yii\helpers\ArrayHelper;
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\Pjax;
    
    $this->title = \Yii::t('app', 'Banner');
    $this->params['breadcrumbs'][] = $this->title;
?>

<div class="subscribers-header">
    <h1 class="box-title no-margin"><?=Html::encode($this->title)?></h1>
    <p>        
        <?= Html::a(Html::tag('i', '', ['class' => 'fa fa-plus fa-fw']) . \Yii::t('app', 'Register new Banner'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
</div>

<?php Pjax::begin(); ?>

<div class="box-body">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'title',
            'client',
            'url:url',
            [
                'filter' => ArrayHelper::map(Banner::find()->select('adspace')->groupBy('adspace')->all(), 'adspace', 'adspace'),
                'attribute' => 'adspace',
            ],
            [
                'filter' => [
                    0 => \Yii::t('app', 'No'),
                    1 => \Yii::t('app', 'Yes'),
                ],
                'attribute' => 'active',
                'value' => function($data) { return $data->active ? \Yii::t('app', 'Yes') : \Yii::t('app', 'No'); },
            ],
            'visit_count',
            'valid_from',
            'valid_until',
            [
                'class' => 'yii\grid\ActionColumn',
                'urlCreator' => function ($action, $model, $key, $index) {
                    return Url::to(['banner/' . $action, 'id' => $model->slug]);
                }
            ],
        ],
    ]); ?>
</div>

<?php Pjax::end(); ?>
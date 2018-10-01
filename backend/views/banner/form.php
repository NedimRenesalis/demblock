<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use kartik\file\FileInput;
    use yii\helpers\Url;

    if ($action == 'update') {
        $this->title = \Yii::t('app', 'Update Banner:  ') . $model->title;
        $this->params['breadcrumbs'][] = ['label' => \Yii::t('app', 'Banner'), 'url' => ['index']];
        $this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->slug]];
        $this->params['breadcrumbs'][] = \Yii::t('app', 'Update');
    }else{
        $this->title = \Yii::t('app', 'Register new Banner');
        $this->params['breadcrumbs'][] = ['label' => \Yii::t('app', 'Banner'), 'url' => ['index']];
        $this->params['breadcrumbs'][] = $this->title;
    }
?>
<div class="subscribers-header">
    <h1 class="box-title no-margin"><?=Html::encode($this->title)?></h1>
    <p>
        <?= Html::a('<i class="fa fa-ban" aria-hidden="true"></i> '.\Yii::t('app', 'Cancel'), ['index'], ['class' => 'btn btn-warning']) ?>
    </p>
</div>

<div class="box-body">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);?>
    <div class="row">
        <div class="col-md-6">
            <?=$form->field($model, 'title')->textInput(['maxlength' => true])?>
            <?=$form->field($model, 'valid_from')->textInput(['type' => 'date'])?>

            <?php 
                if($action == 'update') {
                    echo $form->field($model, 'image')->widget(FileInput::classname(), [
                        'options' => [
                            'accept'    => 'image/*',
                            'multiple'  => false
                        ],
                        'pluginOptions' => [
                            'allowedFileExtensions' => ['jpg', 'jpeg', 'png', 'gif'],
                            'allowedFileTypes'      => ["image"],
                            'overwriteInitial'      => true,

                            'showUpload'    => false,
                            'showPreview'   => true,
                            'showBrowse'    => true,
                            'showClose'     => false,
                            'showRemove'    => false,
                            'allowClear'    => false,
                            'initialize'    => true,

                            'fileActionSettings' => [
                                'showRemove' => false,
                            ],

                            'initialPreview' => [
                                Html::img($model->image, ['class' => 'file-preview-image kv-preview-data']),
                            ],
                        ],
                    ]);   
                }
                else {
                    echo $form->field($model, 'image')->widget(FileInput::classname(), [
                        'options' => [
                            'accept'    => 'image/*',
                            'multiple'  => false
                        ],
                        'pluginOptions' => [
                            'allowedFileExtensions' => ['jpg', 'jpeg', 'png', 'gif'],
                            'allowedFileTypes'      => ["image"],
                            'overwriteInitial'      => true,

                            'fileActionSettings' => [
                                'showRemove' => false,
                            ],

                            'showUpload'    => false,
                            'showPreview'   => true,
                            'showBrowse'    => true,
                            'showRemove'    => true,
                            'removeLabel'   => '',
                            'removeIcon'    => '<i class="glyphicon glyphicon-remove"></i>',
                        ],
                    ]);   
                }
            ?>
        </div>
        <div class="col-md-6">
            <?=$form->field($model, 'adspace')->dropDownList([
                'location_top' => 'Top',
                'location_bottom' => 'Bottom',
                'location_right' => 'Right',
            ])?>
            <?=$form->field($model, 'valid_until')->textInput(['type' => 'date'])?>
            <?=$form->field($model, 'url')->textInput(['maxlength' => true])?>
            <?=$form->field($model, 'client')->textInput(['maxlength' => true])?>
            <?=$form->field($model, 'active')->dropDownList([
                0 => \Yii::t('app', 'No'),
                1 => \Yii::t('app', 'Yes'),
            ])?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?=$form->field($model, 'comment')->textarea(['rows' => 6])?>
        </div>
    </div>

    <div class="box-footer">
        <div class="pull-right">
            <?=Html::submitButton(\Yii::t('app', 'Save'), ['class' => 'btn btn-success'])?>
        </div>
        <div class="clearfix"><!-- --></div>
    </div>

    <?php ActiveForm::end();?>
</div>
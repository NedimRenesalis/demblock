<?php
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use common\models\User;
use dosamigos\ckeditor\CKEditor;
$this->title = 'demblock';
$money = User::getUserMoneyByUsername(Yii::$app->user->identity->username)

?>

<div class="section" id="registration-page">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center">Profil poslodavac</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <img src="<?= Url::to('@web/css/images/registration-left.jpg'); ?>" class="img-responsive">
            </div>
            <div class="col-md-4 text-center">

                <div class="form-group row">
                    <div class="col-sm-12 text-center">
                        <div class="form-group field-user-email">
                            <label class="control-label" for="user-email">Preostali iznos uplaćenog novca</label>
                            <input type="text" id="user-email" class="form-control text-center" name="User[email]"
                                   value="<?= $money; ?>" disabled="">
                            <div class="help-block"></div>
                        </div>
                    </div>
                </div>


                <?php $form = ActiveForm::begin(['id' => 'register-employee-form', 'action' => ['site/profil-poslodavac']]); ?>

                <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>"/>

                <?php if ($model->image != null): ?>
                    <div class="text-center">
                       <b>Logo</b>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12 text-center">
                            <img src="<?= $model->image; ?>">
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($model->banner != null): ?>
                    <div class="text-center">
                        <b>Baner</b>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12 text-center">
                            <img src="<?= $model->banner; ?>">
                        </div>
                    </div>
                <?php endif; ?>

                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'email')->textInput(['disabled' => true])->label('Email adresa') ?>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'full_name')->textInput()->label('Kontakt osoba') ?>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'company_name')->textInput()->label('Naziv firme') ?>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'address')->textInput()->label('Adresa') ?>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'zip_code')->textInput()->label('Poštanski broj') ?>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'phone')->textInput()->label('Kontakt telefon') ?>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'pdv')->textInput()->label('PDV broj') ?>
                    </div>
                </div>


                <div class="form-group has-feedback">
                    <div class="col-sm-12 text-center">
                        <?= $form->field($model, 'company_description')->widget(CKEditor::className(), [
                            'options' => [
                                'rows' => 6,
                            ],
                            'preset' => 'advanced',
                            'clientOptions' => [
                                'language'=>'hr'
                            ]

                        ])->label('Opis kompanije'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12 col-sm-offset- text-center">
                        <input type="submit" class="active btn btn-block btn-info" value="Spasi izmjene"/>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>

                <div class="form-group">
                    <div class="col-sm-12 col-sm-offset- text-center ">
                        <a href="<?= Url::to('upload-logo'); ?>" class="active btn btn-block btn-success">Upload novog
                            loga firme ili izmjena<a/>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12 col-sm-offset- text-center upload-button">
                        <a href="<?= Url::to('upload-banner'); ?>" class="active btn btn-block btn-success">Upload novog
                            banera firme ili izmjena<a/>
                    </div>
                </div>

            </div>
            <div class="col-md-4">
                <img src="<?= Url::to('@web/css/images/registration-right.jpg'); ?>" class="img-responsive">
            </div>
        </div>
    </div>
</div>

<?php if ($registered): ?>
    <div class="just-registered-wrapper">
        <div class="just-registered">
            <div class="close-img">
                <img class="image-responsive" src="<?= Url::to('@web/css/images/close.png') ?>">
            </div>
            Hvala na registraciji<br>
            Molimo upload-ujte logo Vaše firme
        </div>
    </div>
<?php endif; ?>

<script>
    $(document).ready(function () {
        $("body").on("click", function () {
            $(".just-registered-wrapper").hide();
        })
    })
</script>

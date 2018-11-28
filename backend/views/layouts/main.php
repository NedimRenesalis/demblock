<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use common\models\User;
$this->title = 'Zapošljavanje';
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php echo Yii::$app->request->baseUrl; ?>/icon.ico" type="image/x-icon"/>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Zapošljavanje',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [];

    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else if (User::getUserTypeByUsername(Yii::$app->user->identity->username) == 1) {

        $menuItems = [
            ['label' => 'Oglasi', 'url' => ['/advert/index']],
            ['label' => 'Sponzorisani oglasi', 'url' => ['/sponsored/index']],
            ['label' => 'Cijene', 'url' => ['/advert-types/index']],
            ['label' => 'Kategorije', 'url' => ['/categories/index']],
            ['label' => 'Banneri', 'url' => ['/banner/index']],
            ['label' => 'Supplier', 'url' => ['/employer/index']],
            ['label' => 'Buyer', 'url' => ['/employee/index']],
            ['label' => 'Supplier & Buyer', 'url' => ['/supplier-buyer/index']],
            ['label' => 'Subscribers', 'url' => ['/subscribers/index']],
            ['label' => 'Lozinka', 'url' => ['/site/change-password']],
        ];
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }else{
        Yii::$app->user->logout(true);
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

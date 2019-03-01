<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use common\models\User;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;
use app\models\Message;

?>  
<?php
$logoUrl = Url::to('@web/css/images/logo.png');
$ba = Url::to('@web/css/images/bosna.gif');
$en = Url::to('@web/css/images/germany.png');
$de = Url::to('@web/css/images/england.png');
$language = "BA";
AppAsset::register($this);
$languages = "";
$profile = "";

if(!Yii::$app->user->isGuest){
    $language = User::getUserLanguageByUsername(Yii::$app->user->identity->username);
    $messagelabel = '<span class="fas fa-envelope"></span>';
    $unread = Message::find()->where(['to' => Yii::$app->user->identity->id, 'status' => 0])->count();
    if ($unread > 0) {
        $messagelabel .= '(' . $unread . ')';
    }
}

/*if (Yii::$app->user->isGuest) {
    $languages = ' <a class="hidden-sm hidden-xs navbar-brand" id="BA">
                <img alt="Brand" class="center-block language" height="21" src="' . $ba . '">
            </a>';
}*/



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
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <?php $this->head() ?>
        <script type="text/javascript" src="//code.jquery.com/jquery-1.10.0.min.js"></script>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/iframe-resizer/3.6.3/ie8.polyfils.min.js"></script>
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/iframe-resizer/3.6.3/iframeResizer.contentWindow.min.js"></script>
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/iframe-resizer/3.6.3/iframeResizer.min.js"></script>
    </head>
    <body>
    <?php $this->beginBody() ?>


        <?php
        NavBar::begin([
            'brandLabel' => '
            <img src="' . $logoUrl . '" class="img-responsive"> ' . $languages,
            'brandUrl' => Yii::$app->homeUrl . 'index',
            'options' => [
                'id' => 'top',
                'class' => 'navbar-inverse navbar-fixed-top',
            ],

        ]);

        $menuItems = [
            ['label' => 'Home', 'url' => ['index']],
        ];

        $menuItems = [];


        if ($language == "DE") {
            $profile = "Profil";
            $jobs = "Jobs";
        } else if ($language == "EN") {
            $profile = "Profile";
            $jobs = "Jobs";
        } else {
            $profile ="MY DASHBOARD";
            $jobs = "Poslovi";
        }

        if (Yii::$app->user->isGuest) {
            if ($language == "DE") {
                $title = "Anmeldung / Registrierung  ";
                $login = "Anmeldung";
                $profile = "Profil";
                $registration1 = "Registrierung Arbeitnehmer";
                $registration2 = "Registrierung Arbeitgeber";
            } else if ($language == "EN") {
                $title = "Sign In / Registration  ";
                $login = "Sign In";
                $profile = "Profil3";
                $registration1 = "Sign Up Employees";
                $registration2 = "Sign Up Employers";
            } else {
                $title = "Sign in / Register";
                $login = "Sign in";
                $profile = "Profil";
                $register = "Register";
                $registration1 = "Registracija posloprimac";
                $registration2 = "Registracija poslodavac";
            }

            echo '


        <div class="collapse navbar-collapse in" id="navbar-ex-collapse">
        <ul class="nav navbar-nav navbar-right">
            <li>
                <a href="' . Url::to('@web/prijava') . '" class="login-btn">
                    <img src="' .Url::to('@web/css/images/dropdown-img/sign-in.png'). '" />
                    <span>' . $login . '</span>
                </a>
            </li>
            <li>
                <a href="' . Url::to('@web/registracija') . '" class="regist-btn">
                    <img src="' .Url::to('@web/css/images/dropdown-img/registration.png'). '" />
                    <span>Register</span>
                </a>
            </li>
        </ul>
          <p class="navbar-text navbar-right">
            <a href="#" class="navbar-link"></a>
          </p>
          <p class="navbar-text navbar-right">
            <a href="#" class="navbar-link"></a>
          </p>


     ';
        } else {
               $menuItems[] = ['label' => $profile, 'url' => ['/site/user-profile']];
            $menuItems[] = [
                'label' => $messagelabel,
                'url' => '',
                'visible' => !Yii::$app->user->isGuest, 'items' => [
                ['label' => '<i class="fas fa-inbox"></i> Inbox', 'url' => ['message/inbox']],
                ['label' => '<i class="fas fa-share-square"></i> Sent', 'url' => ['message/sent']],
                '<hr>',
                ['label' => '<i class="fas fa-plus"></i> Compose a Message', 'url' => ['message/compose']],
            ]];
            if (User::getUserTypeByUsername(Yii::$app->user->identity->username) == 1) {
                $menuItems = [];
                $menuItems[] = '<li>'
                    . Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton(
                        'Logout',
                        ['class' => 'btn btn-link logout logout-button']
                    )
                    . Html::endForm()
                    . '</li>';

            } else if (User::getUserTypeByUsername(Yii::$app->user->identity->username) == 2) {

             /*   $menuItems[] = ['label' => $profile, 'url' => ['profil-poslodavac']];*/
                $menuItems[] = ['label' => $jobs, 'url' => ['/site/objavljeni-poslovi']];

                $menuItems[] = '<li>'
                    . Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton(
                        'Logout',

                        ['class' => 'btn btn-link logout logout-button']
                    )
                    . Html::endForm()
                    . '</li>';

            } else if (User::getUserTypeByUsername(Yii::$app->user->identity->username) == 3) {

              /*  $menuItems[] = ['label' => $profile, 'url' => ['profil-posloprimac']];*/
                $menuItems[] = ['label' => $jobs, 'url' => ['/site/aplicirani-poslovi']];

                $menuItems[] = '<li>'
                    . Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton(

                        'Logout',
                        ['class' => 'btn btn-link logout logout-button']
                    )
                    . Html::endForm()
                    . '</li>';

            } else if (User::getUserTypeByUsername(Yii::$app->user->identity->username) == 4) {

                $menuItems[] = ['label' => 'Listed products', 'url' => ['/site/objavljeni-poslovi']];
                $menuItems[] = ['label' => 'Tagged products', 'url' => ['/site/aplicirani-poslovi']];

                $menuItems[] = '<li>'
                    . Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton(

                        'LOGOUT',
                        ['class' => 'btn btn-link logout logout-button']
                    )
                    . Html::endForm()
                    . '</li>';

            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
                'encodeLabels' => false,
            ]);
        }

        ?>

        <?php NavBar::end();
        ?>
        <!--
    <div class="container">
        <?php /* echo Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) */ ?>
        <?php echo Alert::widget() ?>
    </div>
    -->
    <div class="main-content">
        <?= $content ?>
    </div>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>

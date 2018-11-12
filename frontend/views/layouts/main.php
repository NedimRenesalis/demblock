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

      <meta name="google-site-verification" content="cv9DJ_dvORsblSg-c3CioTy8v2O-GlmR_wQN1WBqVnU" />
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="google-site-verification" content="vTvqxStkFVTSep1V8y1S-CanMQEHBgJoNxyuUHbaX50"/>
        <link rel="shortcut icon" href="<?php echo Yii::$app->request->baseUrl; ?>/icon.ico" type="image/x-icon"/>
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.0.min.js"></script>


    </head>
    <body>
    <?php $this->beginBody() ?>


    <div class="wrap">
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
            $profile = "Profil";
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
            <li class="active dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">' . $title . '<i class="et-down fa fa-border fa-caret-down pull-right"></i></a>
              <ul class="dropdown-menu" role="menu">
                <li>
                  <a href="' . Url::to('@web/prijava') . '">' . $login . '</a>
                </li>
                <li class="divider"></li>
                <li>
                  <a href="' . Url::to('@web/registracija') . '">' . $register . '</a>
                </li>
              </ul>
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

            if (User::getUserTypeByUsername(Yii::$app->user->identity->username) == 1) {
                $menuItems = [];
                $menuItems[] = '<li>'
                    . Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton(
                        'Logout(' . Yii::$app->user->identity->username . ')',
                        ['class' => 'btn btn-link logout logout-button']
                    )
                    . Html::endForm()
                    . '</li>';
                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav navbar-right'],
                    'items' => $menuItems,
                ]);
            } else if (User::getUserTypeByUsername(Yii::$app->user->identity->username) == 2) {

             /*   $menuItems[] = ['label' => $profile, 'url' => ['profil-poslodavac']];*/
                $menuItems[] = ['label' => $jobs, 'url' => ['objavljeni-poslovi']];

                $menuItems[] = '<li>'
                    . Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->username . ') ',

                        ['class' => 'btn btn-link logout logout-button']
                    )
                    . Html::endForm()
                    . '</li>';

                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav navbar-right'],
                    'items' => $menuItems,
                ]);
            } else if (User::getUserTypeByUsername(Yii::$app->user->identity->username) == 3) {

              /*  $menuItems[] = ['label' => $profile, 'url' => ['profil-posloprimac']];*/
                $menuItems[] = ['label' => $jobs, 'url' => ['aplicirani-poslovi']];

                $menuItems[] = '<li>'
                    . Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton(

                        'Logout(' . Yii::$app->user->identity->username . ')',
                        ['class' => 'btn btn-link logout logout-button']
                    )
                    . Html::endForm()
                    . '</li>';
                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav navbar-right'],
                    'items' => $menuItems,
                ]);
            } else if (User::getUserTypeByUsername(Yii::$app->user->identity->username) == 4) {

                $menuItems[] = ['label' => 'Objavljeni poslovi', 'url' => ['objavljeni-poslovi']];
                $menuItems[] = ['label' => 'Aplicirani poslovi', 'url' => ['aplicirani-poslovi']];

                $menuItems[] = '<li>'
                    . Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton(

                        'Logout(' . Yii::$app->user->identity->username . ')',
                        ['class' => 'btn btn-link logout logout-button']
                    )
                    . Html::endForm()
                    . '</li>';
                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav navbar-right'],
                    'items' => $menuItems,
                ]);
            }
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
    </div>

    <footer class="footer">
        <div class="container">

        </div>
    </footer>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>

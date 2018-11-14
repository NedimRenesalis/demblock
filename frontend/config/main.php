<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'notify' => [
            'class' => '\twisted1919\notify\Notify',
        ],
        'session' => [
            // this is the name of the session cookie used for prijava on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'site/index',
                '/' => 'site/index',
                'index' => 'site/index',
                'prijava' => 'site/prijava',
                'visit' => 'site/visit',
                'subscribe' => 'site/subscribe',
                'registracija-poslodavac' => 'site/registracija-poslodavac',
                'registracija-posloprimac' => 'site/registracija-posloprimac',
                'registracija' => 'site/registracija',
                'trazi-posao' => 'site/trazi-posao',
                'objava-oglasa' => 'site/objava-oglasa',
                'cjenovnik-usluge' => 'site/cjenovnik-usluge',
                'kontakt-prodaja' => 'site/kontakt-prodaja',
                'o-nama' => 'site/o-nama',
                'zasto-odabrati-nas' => 'site/zasto-odabrati-nas',
                'uslovi-koristenja' => 'site/uslovi-koristenja',
                'impressum' => 'site/impressum',
                'privatnost' => 'site/privatnost',
                'zahtjev-za-novu-lozinku' => 'site/zahtjev-za-novu-lozinku',
                'zaboravljena-lozinka' => 'site/zaboravljena-lozinka',
                'profil-poslodavac' => 'site/profil-poslodavac',
                'profil-posloprimac' => 'site/profil-posloprimac',
                'poslodavac-profil/<id:\d+>' => 'site/poslodavac-profil',
                'posloprimac-profil/<id:\d+>' => 'site/posloprimac-profil',
                'oglas/<id:\d+>' => 'site/oglas',
                'html/<id:\d+>' => 'site/html',
                'pdf/<id:\d+>' => 'site/pdf',
                'upload-logo' => 'site/upload-logo',
                'upload-banner' => 'site/upload-banner',
                'upload-cv' => 'site/upload-cv',
                'upload-logo-form' => 'site/upload-logo-form',
                'remove-photo' => 'site/remove-photo',
                'sort-photos' => 'site/sort-photos',
                'upload-photos' => 'site/upload-photos',
                'upload-cv-form' => 'site/upload-cv-form',
                'download-cv' => 'site/download-cv',
                'oglasi' => 'site/oglasi',
                'apply' => 'site/apply',
                'objavljeni-poslovi' => 'site/objavljeni-poslovi',
                'aplicirani-poslovi' => 'site/aplicirani-poslovi',
                'aplikacije' => 'site/aplikacije',
                'obnovi-oglas' => 'site/obnovi-oglas',
                'zahvala-za-placanje' => 'site/zahvala-za-placanje',
                'user-profile' => 'site/user-profile',
                'edit-user-contact-details' => 'site/edit-user-contact-details'
            ],
        ],
    ],
    'params' => $params,
];

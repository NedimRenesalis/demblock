<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'aliases' => [
        '@banner' => '/frontend/web/uploads/banner',
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=zaposljavanje',
            'username' => 'zaposljavanje',
            'password' => 'noviposao2017',
            'charset' => 'utf8',
        ],
        'mail' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
            'viewPath' => '@common/mail',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'support@demblock.com',
                'password' => '123Lolakola!!',
                'port' => '587',
                'encryption' => 'tls',
            ],
        ],
    ],
];

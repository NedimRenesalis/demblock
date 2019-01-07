<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=zaposljavanje',
            'username' => 'zaposljavanje',
            'password' => 'noviposao2017',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'support@demblock.com',
                'password' => 'Lolakola123!!',
                'port' => '587',
                'encryption' => 'tls',
            ],
        ],
    ],
];

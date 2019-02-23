<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=mysql;dbname='.getenv("MYSQL_DATABASE").'',
            'username' => ''.getenv("MYSQL_USER").'',
            'password' => ''.getenv("MYSQL_PASSWORD").'',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
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

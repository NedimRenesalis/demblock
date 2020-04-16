<?php
return [
    'components' => [
        'urlManagerFrontend' => [
            'class' => 'common\components\UrlManager',
            'subDomain' => Yii::getAlias('@frontendSubdomain'),
            'domainName' => Yii::getAlias('@domainName'),
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        'urlManagerBackend' => [
            'class' => 'common\components\UrlManager',
            'subDomain' => Yii::getAlias('@backendSubdomain'),
            'domainName' => Yii::getAlias('@domainName'),
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host='.getenv("MYSQL_HOST").';dbname='.getenv("MYSQL_DATABASE").'',
            'username' => getenv("MYSQL_USER"),
            'password' => getenv("MYSQL_PASSWORD"),
            'charset' => 'utf8',
        ],
        'mailer' => [
          'class' => 'yii\swiftmailer\Mailer',
          'viewPath' => '@common/mail',
          'transport' => [
              'class' => 'Swift_SmtpTransport',
              'host' => getenv("MAILER_HOST"),
              'username' => getenv("MAILER_USERNAME"),
              'password' => getenv("MAILER_PASSWORD"),
              'port' => getenv("MAILER_PORT"),
              'encryption' => 'tls',
              'streamOptions' => [
                  'ssl' => [
                      'allow_self_signed' => true,
                      'verify_peer' => false,
                      'verify_peer_name' => false,
                  ],
              ],
          ],
        ],
    ],
];

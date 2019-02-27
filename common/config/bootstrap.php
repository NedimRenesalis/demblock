<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');

// URL Manager Aliases
Yii::setAlias('@domainName', (YII_ENV === 'dev') ? 'localhost' : 'demblock.com');
Yii::setAlias('@frontendSubdomain', '');
Yii::setAlias('@backendSubdomain', 'backend');
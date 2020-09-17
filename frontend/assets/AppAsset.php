<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        //'css/site.css',
        'css/all.min.css',
        'css/v4-shims.css',
        'css/main.css',
        'css/index.css',
        'css/flags.css'
    ];

    public $js = [
        'js/js.cookie.js',
        'js/typed.js',
        'js/iconify.min.js',
        'js/choreographer.min.js',
        'js/anime.min.js',
        'js/index.js',
        'js/mailtoui-min.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}

<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend particle asset bundle.
 */
class ParticleAssets extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];

    public $js = [
        'js/load.particles.js',
        'js/particle.min.js'
    ];

    public $depends = [
    ];
}

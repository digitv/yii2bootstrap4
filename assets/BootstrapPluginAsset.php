<?php

namespace digitv\bootstrap\assets;

use yii\web\AssetBundle;

/**
 * Class BootstrapPluginAsset
 * @package digitv\bootstrap\assets
 */
class BootstrapPluginAsset extends AssetBundle
{
    public $sourcePath = '@vendor/twbs/bootstrap/dist/js';
    public $js = [
        'bootstrap.bundle.min.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
<?php

namespace digitv\yii2bootstrap4\assets;

use yii\web\AssetBundle;

/**
 * Class BootstrapPluginAsset
 * @package digitv\yii2bootstrap4\assets
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
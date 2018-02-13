<?php

namespace digitv\yii2bootstrap4\assets;

use yii\web\AssetBundle;

/**
 * Class AssetBootstrap4
 * @package digitv\yii2bootstrap4
 */
class BootstrapAsset extends AssetBundle
{
    public $sourcePath = '@vendor/twbs/bootstrap/dist/css';
    public $css = [
        'bootstrap.min.css',
    ];
}
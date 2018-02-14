<?php

namespace digitv\bootstrap\assets;

use yii\web\AssetBundle;

/**
 * Class AssetBootstrap4
 * @package digitv\bootstrap
 */
class BootstrapAsset extends AssetBundle
{
    public $sourcePath = '@vendor/twbs/bootstrap/dist/css';
    public $css = [
        'bootstrap.min.css',
    ];
}
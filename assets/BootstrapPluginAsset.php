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
    public $js = [];

    public $depends = [
        'yii\web\JqueryAsset',
    ];

    /**
     * @inheritdoc
     */
    public function init()
    {
        //Add js depending on user environment
        $this->js[] = YII_ENV_DEV ? 'bootstrap.bundle.js' : 'bootstrap.bundle.min.js';
        parent::init();
    }
}
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
    public $css = [];

    /**
     * @inheritdoc
     */
    public function init()
    {
        //Add css depending on user environment
        $this->css[] = YII_ENV_DEV ? 'bootstrap.css' : 'bootstrap.min.css';
        parent::init();
    }
}
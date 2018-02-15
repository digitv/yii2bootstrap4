<?php

namespace digitv\bootstrap\assets;

use yii\web\AssetBundle;

/**
 * Asset bundle for the Twitter bootstrap v4 grid.
 *
 * @link http://getbootstrap.com/docs/4.0/layout/grid
 * @author Digit <digit.vova@gmail.com>
 */
class BootstrapGridAsset extends AssetBundle
{
    public $sourcePath = '@vendor/twbs/bootstrap/dist/css';
    public $css = [];
    public $depends = [];

    /**
     * @inheritdoc
     */
    public function init()
    {
        //Add css depending on user environment
        $this->css[] = YII_ENV_DEV ? 'bootstrap-grid.css' : 'bootstrap-grid.min.css';
        parent::init();
    }
}

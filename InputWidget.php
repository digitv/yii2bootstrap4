<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace digitv\yii2bootstrap4;

/**
 * InputWidget is an adjusted for bootstrap needs version of [[\yii\widgets\InputWidget]].
 *
 * @author Paul Klimov <klimov.paul@gmail.com>
 * @since 2.0.6
 */
class InputWidget extends \yii\widgets\InputWidget
{
    use BootstrapWidgetTrait;

    /**
     * @inheritdoc
     */
    public static function widget($config = [])
    {
        return parent::widget($config);
    }
}

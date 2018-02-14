<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace digitv\bootstrap\widgets;

use digitv\bootstrap\assets\BootstrapPluginAsset;
use digitv\bootstrap\Html;
use digitv\bootstrap\Widget;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;

/**
 * Dropdown renders a Bootstrap dropdown menu component.
 *
 * For example,
 *
 * ```php
 * <div class="dropdown">
 *     <a href="#" data-toggle="dropdown" class="dropdown-toggle">Label <b class="caret"></b></a>
 *     <?php
 *         echo Dropdown::widget([
 *             'items' => [
 *                 ['label' => 'DropdownA', 'url' => '/'],
 *                 ['label' => 'DropdownB', 'url' => '#'],
 *             ],
 *         ]);
 *     ?>
 * </div>
 * ```
 * @see http://getbootstrap.com/javascript/#dropdowns
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @since 2.0
 */
class Dropdown extends Widget
{
    const DIVIDER = 'divider';

    /**
     * @var array list of menu items in the dropdown. Each array element can be either an HTML string,
     * or an array representing a single menu with the following structure:
     *
     * - label: string, required, the label of the item link.
     * - encode: boolean, optional, whether to HTML-encode item label.
     * - url: string|array, optional, the URL of the item link. This will be processed by [[\yii\helpers\Url::to()]].
     *   If not set, the item will be treated as a menu header when the item has no sub-menu.
     * - visible: boolean, optional, whether this menu item is visible. Defaults to true.
     * - linkOptions: array, optional, the HTML attributes of the item link.
     * - options: array, optional, the HTML attributes of the item.
     * - items: array, optional, the submenu items. The structure is the same as this property.
     *   Note that Bootstrap doesn't support dropdown submenu. You have to add your own CSS styles to support it.
     * - submenuOptions: array, optional, the HTML attributes for sub-menu container tag. If specified it will be
     *   merged with [[submenuOptions]].
     *
     * To insert divider use Dropdown::DIVIDER.
     */
    public $items = [];
    /**
     * @var boolean whether the labels for header items should be HTML-encoded.
     */
    public $encodeLabels = true;

    /**
     * Initializes the widget.
     * If you override this method, make sure you call the parent implementation first.
     */
    public function init()
    {
        parent::init();
        Html::addCssClass($this->options, ['widget' => 'dropdown-menu']);
    }

    /**
     * Renders the widget.
     * @return string
     * @throws InvalidConfigException
     */
    public function run()
    {
        BootstrapPluginAsset::register($this->getView());
        $this->registerClientEvents();
        return $this->renderItems($this->items, $this->options);
    }

    /**
     * Renders menu items.
     * @param array $items the menu items to be rendered
     * @param array $options the container HTML attributes
     * @return string the rendering result.
     * @throws InvalidConfigException if the label option is not specified in one of the items.
     */
    protected function renderItems($items, $options = [])
    {
        $lines = [];
        foreach ($items as $item) {
            if (is_string($item)) {
                if($item === static::DIVIDER) $lines[] = $this->renderDivider();
                else $lines[] = $item;
                continue;
            }
            if (isset($item['visible']) && !$item['visible']) {
                continue;
            }
            if (!array_key_exists('label', $item)) {
                throw new InvalidConfigException("The 'label' option is required.");
            }
            $encodeLabel = isset($item['encode']) ? $item['encode'] : $this->encodeLabels;
            $label = $encodeLabel ? Html::encode($item['label']) : $item['label'];
            $itemOptions = ArrayHelper::getValue($item, 'options', []);
            $linkOptions = ArrayHelper::getValue($item, 'linkOptions', []);
            $itemOptions = ArrayHelper::merge($itemOptions, $linkOptions);
            Html::addCssClass($itemOptions, ['widget' => 'dropdown-item']);
            $url = array_key_exists('url', $item) ? $item['url'] : null;
            if ($url === null) {
                Html::addCssClass($itemOptions, ['widget' => 'dropdown-header']);
                $content = $this->renderHeader($label);
            } else {
                $content = Html::a($label, $url, $itemOptions);
            }

            $lines[] = $content;
        }

        return Html::tag('div', implode("\n", $lines), $options);
    }

    /**
     * Renders divider
     * @param string $tag
     * @return string
     */
    protected function renderDivider($tag = 'div') {
        return Html::tag($tag, '', ['class' => 'dropdown-divider']);
    }

    /**
     * Renders header
     * @param string $content
     * @param string $tag
     * @return string
     */
    protected function renderHeader($content = '', $tag = 'h6') {
        return Html::tag($tag, $content, ['class' => 'dropdown-header']);
    }
}

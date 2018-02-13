<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace digitv\yii2bootstrap4\widgets;

use digitv\yii2bootstrap4\assets\BootstrapAsset;
use digitv\yii2bootstrap4\Html;
use digitv\yii2bootstrap4\Widget;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;

/**
 * Progress renders a bootstrap progress bar component.
 *
 * For example,
 *
 * ```php
 * // default with label
 * echo Progress::widget([
 *     'percent' => 60,
 *     'label' => 'test',
 * ]);
 *
 * // styled
 * echo Progress::widget([
 *     'percent' => 65,
 *     'barOptions' => ['class' => 'bg-danger']
 * ]);
 *
 * // styled and animated
 * echo Progress::widget([
 *     'percent' => 65,
 *     'animated' => true,
 *     'barOptions' => ['class' => 'bg-danger']
 * ]);
 *
 * // striped
 * echo Progress::widget([
 *     'percent' => 70,
 *     'striped' => true,
 *     'barOptions' => ['class' => 'bg-warning'],
 * ]);
 *
 * // striped animated
 * echo Progress::widget([
 *     'percent' => 70,
 *     'animated' => true,
 *     'barOptions' => ['class' => 'bg-success'],
 * ]);
 *
 * // stacked bars
 * echo Progress::widget([
 *     'bars' => [
 *         ['percent' => 30, 'options' => ['class' => 'bg-danger']],
 *         ['percent' => 30, 'label' => 'test', 'animated' => true, 'options' => ['class' => 'bg-success']],
 *         ['percent' => 35, 'options' => ['class' => 'bg-warning']],
 *     ]
 * ]);
 * ```
 * @see http://getbootstrap.com/components/#progress
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @author Alexander Makarov <sam@rmcreative.ru>
 * @since 2.0
 */
class Progress extends Widget
{
    /**
     * @var string the button label.
     */
    public $label;
    /**
     * @var integer the amount of progress as a percentage.
     */
    public $percent = 0;
    /**
     * @var array the HTML attributes of the bar.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $barOptions = [];
    /**
     * @var array a set of bars that are stacked together to form a single progress bar.
     * Each bar is an array of the following structure:
     *
     * ```php
     * [
     *     // required, the amount of progress as a percentage.
     *     'percent' => 30,
     *     // optional, the label to be displayed on the bar
     *     'label' => '30%',
     *     // optional, array, additional HTML attributes for the bar tag
     *     'options' => [],
     * ]
     * ```
     */
    public $bars;
    /**
     * @var bool animated or not
     */
    public $animated = false;
    /**
     * @var bool striped or not
     */
    public $striped = false;


    /**
     * Initializes the widget.
     * If you override this method, make sure you call the parent implementation first.
     */
    public function init()
    {
        parent::init();
        Html::addCssClass($this->options, ['widget' => 'progress']);
    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        BootstrapAsset::register($this->getView());
        return implode("\n", [
            Html::beginTag('div', $this->options),
            $this->renderProgress(),
            Html::endTag('div')
        ]) . "\n";
    }

    /**
     * Renders the progress.
     * @return string the rendering result.
     * @throws InvalidConfigException if the "percent" option is not set in a stacked progress bar.
     */
    protected function renderProgress()
    {
        if (empty($this->bars)) {
            $config = ['percent' => $this->percent, 'animated' => $this->animated, 'striped' => $this->striped];
            return $this->renderBar($config, $this->label, $this->barOptions);
        }
        $bars = [];
        foreach ($this->bars as $bar) {
            $label = ArrayHelper::getValue($bar, 'label', '');
            if (!isset($bar['percent'])) {
                throw new InvalidConfigException("The 'percent' option is required.");
            }
            $options = ArrayHelper::getValue($bar, 'options', []);
            $bars[] = $this->renderBar($bar, $label, $options);
        }

        return implode("\n", $bars);
    }
    /**
     * Generates a bar
     * @param array $config the bar config (percentage, striped, animated)
     * @param string $label, optional, the label to display at the bar
     * @param array $options the HTML attributes of the bar
     * @return string the rendering result.
     */
    protected function renderBar($config = [], $label, $options = []) {
        $percent = ArrayHelper::getValue($config, 'percent', 0);
        $animated = ArrayHelper::getValue($config, 'animated', false);
        $striped = ArrayHelper::getValue($config, 'striped', false) || $animated;
        $percentFixed = number_format($percent, 2, '.', '');
        $defaultOptions = [
            'role' => 'progressbar',
            'aria-valuenow' => $percent,
            'aria-valuemin' => 0,
            'aria-valuemax' => 100,
            'style' => "width:{$percentFixed}%",
        ];
        $options = array_merge($defaultOptions, $options);
        Html::addCssClass($options, ['widget' => 'progress-bar']);
        if($animated)
            Html::addCssClass($options, ['animated' => 'progress-bar-animated']);
        if($striped)
            Html::addCssClass($options, ['striped' => 'progress-bar-striped']);

        $out = Html::beginTag('div', $options);
        $out .= $label;
        $out .= Html::tag('span', \Yii::t('yii', '{percent}% Complete', ['percent' => $percent]), [
            'class' => 'sr-only'
        ]);
        $out .= Html::endTag('div');

        return $out;
    }
}

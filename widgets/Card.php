<?php

namespace digitv\yii2bootstrap4\widgets;

use digitv\yii2bootstrap4\Html;
use digitv\yii2bootstrap4\Widget;
use yii\helpers\ArrayHelper;

class Card extends Widget
{
    public $tag = 'div';

    public $headerImage;

    public $headerImageOptions = [];

    public $header;

    public $headerOptions = [];

    public $body;

    public $bodyOptions = [];

    public $footer;

    public $footerOptions = [];

    public $footerImage;

    public $footerImageOptions = [];

    public $overlayImage;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        Html::addCssClass($this->options, ['widget' => 'card']);
        ob_start();
        ob_implicit_flush(true);
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $content = [];
        $content[] = Html::beginTag($this->tag, $this->options);
        $content[] = $this->renderHeader();
        $content[] = $this->renderHeaderImage();
        $content[] = $this->renderOverlayImage();
        $content[] = $this->renderBody(null, true);
        $content[] = $this->renderFooter();
        $content[] = Html::endTag($this->tag);
        return implode("\n", $content);
    }

    /**
     * Render card header
     * @return string
     */
    protected function renderHeader() {
        if(!isset($this->header)) return '';
        if(isset($this->headerOptions)) {
            Html::addCssClass($this->headerOptions, ['widget' => 'card-header']);
            $tag = ArrayHelper::remove($this->headerOptions, 'tag', 'div');
            $header = Html::tag($tag, $this->header, $this->headerOptions);
        } else {
            $header = $this->header;
        }
        return $header;
    }

    /**
     * Render card top image
     * @return string
     */
    protected function renderHeaderImage() {
        if(!isset($this->headerImage)) return '';
        Html::addCssClass($this->headerImageOptions, ['widget' => 'card-img-top']);
        return Html::img($this->headerImage, $this->headerImageOptions);
    }

    /**
     * Render card bottom image
     * @return string
     */
    protected function renderFooterImage() {
        if(!isset($this->footerImage)) return '';
        Html::addCssClass($this->footerImageOptions, ['widget' => 'card-img-bottom']);
        return Html::img($this->footerImage, $this->footerImageOptions);
    }

    /**
     * Render card bottom image
     * @return string
     */
    protected function renderOverlayImage() {
        if(!isset($this->overlayImage)) return '';
        Html::addCssClass($this->footerImageOptions, ['widget' => 'card-img-bottom']);
        return Html::img($this->overlayImage, ['class' => 'card-img']);
    }

    /**
     * Render card body
     * @param string $body
     * @param bool   $includeOb
     * @return string
     */
    protected function renderBody($body = null, $includeOb = false) {
        $body = isset($body) ? $body : $this->body;
        $bodyContent = '';
        $bodyTag = 'div';
        if(is_array($body)) {
            $bodyRows = [];
            foreach ($body as $bodyRow) {
                $bodyRowContent = $this->renderBody($bodyRow);
                if(empty($bodyRowContent)) continue;
                $bodyRows[] = $bodyRowContent;
            }
            $bodyContent = implode("\n", $bodyRows);
        } else {
            if(isset($this->bodyOptions)) {
                if(isset($this->overlayImage)) {
                    Html::addCssClass($this->bodyOptions, ['widget' => 'card-img-overlay']);
                } else {
                    Html::addCssClass($this->bodyOptions, ['widget' => 'card-body']);
                }
                $bodyTag = ArrayHelper::remove($this->bodyOptions, 'tag', 'div');
                $bodyOptions = $this->bodyOptions;
            }
            if(isset($body)) {
                $bodyContent .= $body;
            }
        }
        if($includeOb) {
            $bodyContent .= ob_get_clean();
        }
        return isset($bodyOptions) ? Html::tag($bodyTag, $bodyContent, $bodyOptions) : $bodyContent;
    }

    /**
     * Render card footer
     * @return string
     */
    protected function renderFooter() {
        if(!isset($this->footer)) return '';
        if(isset($this->footerOptions)) {
            Html::addCssClass($this->footerOptions, ['widget' => 'card-footer']);
            $tag = ArrayHelper::remove($this->footerOptions, 'tag', 'div');
            $footer = Html::tag($tag, $this->footer, $this->footerOptions);
        } else {
            $footer = $this->footer;
        }
        return $footer;
    }
}
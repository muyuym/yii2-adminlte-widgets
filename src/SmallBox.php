<?php

namespace hail812\adminlte\widgets;

use yii\helpers\Html;

/**
 * Class SmallBox
 * @package hail812\adminlte\widgets
 */
class SmallBox extends Widget
{
    public $title;

    public $text;

    public $icon;

    public $theme;

    public $linkText;

    public $linkUrl;

    public $linkOptions = [];

    public function init()
    {
        parent::init();

        $this->initOptions();

        echo Html::beginTag('div', $this->options) . "\n";
        echo $this->renderInner() . "\n";
        echo $this->renderIcon() . "\n";
        echo $this->renderFooter() . "\n";
    }

    public function run()
    {
        echo $this->renderLoadingStyle(['iconSize' => 'fa-3x']);
        echo "\n" . Html::endTag('div');
    }

    protected function renderInner()
    {
        $h = Html::tag('h3', $this->title);
        $p = Html::tag('p', $this->text);
        $inner = Html::tag('div', $h . $p, ['class' => 'inner']);

        return $inner;
    }

    protected function renderIcon()
    {
        $i = Html::tag('i', '', ['class' => $this->icon]);
        $icon = Html::tag('div', $i, ['class' => 'icon']);

        return $icon;
    }

    protected function renderFooter()
    {
        $i = Html::tag('i', '', ['class' => 'fas fa-arrow-circle-right']);

        if ($this->linkText !== false) {
            empty($this->linkText) && $this->linkText = 'More info';
        }
        $a = Html::a($this->linkText.' '.$i, $this->linkUrl, $this->linkOptions);

        return $a;
    }

    /**
     * Initializes the widget options
     * This method sets the default values for various options.
     */
    protected function initOptions()
    {
        $this->options = array_merge([
            'class' => 'small-box'
        ], $this->options);
        $this->theme || $this->theme = 'info';
        Html::addCssClass($this->options, 'bg-'.$this->theme);

        $this->linkOptions = array_merge([
            'class' => 'small-box-footer'
        ], $this->linkOptions);
    }
}
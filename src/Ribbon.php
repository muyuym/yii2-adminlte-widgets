<?php

namespace hail812\adminlte\widgets;

use yii\helpers\Html;

/**
 * Class Ribbon
 * @package hail812\adminlte\widgets
 *
 * ```php
 * echo Ribbon::widget([
 *      'text' => 'Ribbon',
 *      'theme' => 'info',
 *      'size' => 'lg',
 *      'textSize' => 'lg',
 * ])
 * ```
 */
class Ribbon extends Widget
{
    public $text;

    /**
     * primary, secondary, info, success
     * @var string
     */
    public $theme;

    /**
     * ribbon size
     * lg - large
     * xl - extra large
     * @var string
     */
    public $size;

    /**
     * text size
     * @var string
     */
    public $textSize;

    public $textOptions = [];

    public function init()
    {
        parent::init();

        $this->initOptions();

        echo Html::beginTag('div', $this->options) . "\n";
        echo $this->renderText() . "\n";
    }

    public function run()
    {
        echo "\n" . Html::endTag('div');
    }

    protected function renderText()
    {
        $ribbon = Html::tag('div', $this->text, $this->textOptions);
        return $ribbon;
    }

    protected function initOptions()
    {
        $this->options = array_merge([
            'class' => 'ribbon-wrapper'
        ], $this->options);
        $this->size && Html::addCssClass($this->options, 'ribbon-'.$this->size);

        $this->textOptions = array_merge([
            'class' => 'ribbon'
        ], $this->textOptions);
        $this->theme || $this->theme = 'primary';
        Html::addCssClass($this->textOptions, 'bg-'.$this->theme);
        $this->textSize && Html::addCssClass($this->textOptions, 'text-'.$this->textSize);
    }
}
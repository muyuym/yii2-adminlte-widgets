<?php

namespace hail812\adminlte\widgets;

use yii\helpers\Html;

/**
 * Class InfoBox
 * @package hail812\adminlte\widgets
 */
/*
    InfoBox::widget([
        'id' => 'message-info-box',
        'text' => 'Messages',
        'number' => '1,410',
        'icon' => 'far fa-envelope'
    ])

    InfoBox::widget([
        'id' => 'bookmark-info-box',
        'text' => 'Bookmarks',
        'number' => '410',
        'theme' => 'success',
        'icon' => 'far fa-flag',
        'progress' => [
            'width' => '70%',
            'description' => '70% Increase in 30 Days'
        ],
        'loadingStyle' => true
    ])
*/
class InfoBox extends Widget
{
    public $text;

    public $number;

    /**
     * primary, secondary, success, info, warning, danger, dark
     * gradient-primary, gradient-secondary
     *
     * @var string
     */
    public $theme;

    public $icon;

    public $iconTheme;

    public $iconOptions = [];

    public $contentOptions = [];

    /**
     * [
     *      'width' => '70%',
     *      'description' => '70% Increase in 30 Days'
     * ]
     *
     * @var array
     */
    public $progress;

    public $progressBarTheme;

    public $progressBarOptions = [];

    public function init()
    {
        parent::init();

        $this->initOptions();

        echo Html::beginTag('div', $this->options) . "\n";
        echo $this->renderIcon() . "\n";
        echo $this->renderContent() . "\n";
    }

    public function run()
    {
        echo $this->renderLoadingStyle();
        echo "\n" . Html::endTag('div');
    }

    protected function renderIcon()
    {
        if (!$this->isShowIcon()) {
            return;
        }

        $icon = Html::tag('i', '', ['class' => $this->icon]);

        return Html::tag('span', $icon, $this->iconOptions);
    }

    protected function renderContent()
    {
        $content = "\n" . $this->renderText();
        $content .= "\n" . $this->renderNumber();
        $content .= "\n" .$this->renderProgressBar();

        return Html::tag('div', $content, $this->contentOptions);
    }

    protected function renderText()
    {
        return Html::tag('span', $this->text, ['class' => 'info-box-text']);
    }

    protected function renderNumber()
    {
        return Html::tag('span', $this->number, ['class' => 'info-box-number']);
    }

    protected function renderProgressBar()
    {
        if (!$this->isShowProgress()) {
            return;
        }

        $progressBar = Html::tag('div', '', $this->progressBarOptions);
        $progress = Html::tag('div', $progressBar, ['class' => 'progress']);
        $progressDescription = isset($this->progress['description']) ? Html::tag('span', $this->progress['description'], ['class' => 'progress-description']) : '';

        return $progress . $progressDescription;
    }

    /**
     * Initializes the widget options
     * This method sets the default values for various options.
     */
    protected function initOptions()
    {
        $this->options = array_merge([
            'class' => 'info-box'
        ], $this->options);
        $this->theme && Html::addCssClass($this->options, 'bg-'.$this->theme);

        if ($this->isShowIcon()) {
            $this->iconOptions = array_merge([
                'id' => $this->options['id'] . '-icon',
                'class' => 'info-box-icon'
            ], $this->iconOptions);
            $this->theme || $this->iconTheme || $this->iconTheme = 'info';
            Html::addCssClass($this->iconOptions, 'bg-'.$this->iconTheme);
        }

        $this->contentOptions = array_merge([
            'id' => $this->options['id'] . '-content',
            'class' => 'info-box-content'
        ], $this->contentOptions);

        if ($this->isShowProgress()) {
            $this->progressBarOptions = array_merge([
                'class' => 'progress-bar'
            ], $this->progressBarOptions);
            $this->theme || $this->progressBarTheme || $this->progressBarTheme = 'info';
            Html::addCssClass($this->progressBarOptions, 'bg-'.$this->progressBarTheme);
            Html::addCssStyle($this->progressBarOptions, ['width' => $this->progress['width']]);
        }
    }

    protected function isShowIcon()
    {
        return !empty($this->icon);
    }

    protected function isShowProgress()
    {
        return isset($this->progress['width']);
    }
}
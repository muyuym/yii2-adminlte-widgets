<?php

namespace hail812\adminlte\widgets;

use yii\helpers\Html;

class LoadingStyle extends Widget
{
    public $iconSize;

    public function init()
    {
        parent::init();

        $this->initOptions();
    }

    public function run()
    {
        $i = Html::tag('i', '', ['class' => "fas {$this->iconSize} fa-sync-alt fa-spin"]);
        $overlay = Html::tag('div', $i, $this->options);
        return $overlay;
    }

    protected function initOptions()
    {
        $this->options = array_merge([
            'class' => 'overlay'
        ], $this->options);

        $this->iconSize = $this->iconSize ?? 'fa-2x';
    }
}
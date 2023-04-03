<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    public $title, $css, $js;
    public function __construct($title = null, $css = null, $js = null)
    {
        $this->title = $title;
        $this->css = $css;
        $this->js = $js;
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.app');
    }
}

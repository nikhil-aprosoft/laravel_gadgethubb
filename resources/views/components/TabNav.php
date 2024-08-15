<?php
namespace App\View\Components;

use Illuminate\View\Component;

class TabNav extends Component
{
    public $tabs;

    public function __construct($tabs)
    {
        $this->tabs = $tabs;
    }

    public function render()
    {
        return view('components.tab-nav');
    }
}
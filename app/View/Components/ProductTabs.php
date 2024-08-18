<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ProductTabs extends Component
{
    public $tabs;

    /**
     * Create a new component instance.
     *
     * @param array $tabs
     */
    public function __construct(array $tabs)
    {
        $this->tabs = $tabs;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.product-tabs');
    }
}

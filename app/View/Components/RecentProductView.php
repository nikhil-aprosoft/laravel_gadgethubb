<?php

namespace App\View\Components;

use Illuminate\View\Component;

class RecentProductView extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $recentViews;
    
    public function __construct($recentViews)
    {
        $this->recentViews = $recentViews;
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.recent-product-view');
    }
}

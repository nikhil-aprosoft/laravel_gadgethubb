<?php
// app/View/Components/ShoesSection.php
namespace App\View\Components;

use Illuminate\View\Component;

class ShoesSection extends Component
{
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function render()
    {
        return view('components.shoes-section', ['data' => $this->data]);
    }
}


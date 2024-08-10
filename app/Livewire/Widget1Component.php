<?php

namespace App\Livewire;

use Livewire\Component;

class Widget1Component extends Component
{
    public $dateRange;
    public $number;
    public $title;
    public $percentageChange;
    public $comparisonText;
    
    public function render()
    {
        return view('livewire.widget1-component');
    }
}

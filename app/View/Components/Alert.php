<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{
    public $type;
    public $dismissible;

    public function __construct($type = 'info', $dismissible = false)
    {
        $this->type = $type;
        $this->dismissible = $dismissible;
    }

    public function render()
    {
        return view('components.alert');
    }
}

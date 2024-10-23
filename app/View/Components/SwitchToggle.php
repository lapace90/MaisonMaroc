<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SwitchToggle extends Component
{
    public $id;
    public $name;
    public $checked;
    public $label;

    public function __construct($id, $name, $checked = false, $label = '')
    {
        $this->id = $id;
        $this->name = $name;
        $this->checked = $checked;
        $this->label = $label;
    }

    public function render()
    {
        return view('components.switch-toggle');
    }
}

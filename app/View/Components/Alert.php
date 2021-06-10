<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{
    public $error_message;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($error_message = '')
    {
        $this->error_message = $error_message;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.alert')->with('error_message', $this->error_message);
    }
}

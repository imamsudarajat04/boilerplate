<?php

namespace App\View\Components\Layouts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ButtonCreate extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public string $createUrl, public string $btnCreateClass = "")
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.button-create');
    }
}

<?php

namespace App\View\Components\Layouts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EmptyData extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public string $title = "Data Not Found", public string $description = "The data that you are looking for does not exists", public string $class = "")
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.empty-data');
    }
}

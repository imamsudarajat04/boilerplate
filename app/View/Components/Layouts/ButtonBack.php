<?php

namespace App\View\Components\Layouts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\URL;
use Illuminate\View\Component;

class ButtonBack extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public string|null $backUrl = null)
    {
        if (is_null($this->backUrl)) {
            $this->backUrl = URL::previousPath();
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layouts.button-back');
    }
}

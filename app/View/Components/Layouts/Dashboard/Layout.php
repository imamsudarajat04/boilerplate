<?php

namespace App\View\Components\Layouts\Dashboard;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\View as FacadesView;

class Layout extends Component
{
    public string $_title;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->_title = FacadesView::getShared()["title"] ?? config("app_name");
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layouts.dashboard.layout');
    }
}

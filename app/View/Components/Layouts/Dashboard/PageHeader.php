<?php

namespace App\View\Components\Layouts\Dashboard;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\View as FacadesView;

class PageHeader extends Component
{
    public string $lastBreadcrumbKey;
    public string $_pageTitle;
    public string $_pageSubtitle;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $sharedView = FacadesView::getShared();

        $breadcrumbs = array_keys($sharedView["breadcrumbs"]);
        $this->lastBreadcrumbKey = end($breadcrumbs);
        $this->_pageTitle = $sharedView["pageTitle"] ?? "";
        $this->_pageSubtitle = $sharedView["pageSubTitle"] ?? "";
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layouts.dashboard.page-header');
    }
}

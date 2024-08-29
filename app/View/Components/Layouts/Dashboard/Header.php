<?php

namespace App\View\Components\Layouts\Dashboard;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Header extends Component
{
    public string $_name;
    public string$_roleName;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $user = Auth::user();
        $this->_name = ucwords($user->name) ?? "-";
        $this->_roleName = "";
        $this->setRoleName();
    }

    /**
     * @return void
     */
    protected function setRoleName(): void
    {
        $isFirst = true;
        foreach (Auth::user()->getRoleNames() as $key => $roleName) {
            if ($key > 2) {
                break;
            }

            if($isFirst) {
                $isFirst = false;
            }else{
                $this->_roleName .= " | ";
            }
            $this->_roleName .= $roleName;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layouts.dashboard.header');
    }
}

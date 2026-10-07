<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sidebar extends Component
{
    public array $menus;

    public $user;

    public function __construct($user, array $menus)
    {
        $this->user = $user;
        $this->menus = $menus;
    }

    public function render(): View|Closure|string
    {
        return view('components.sidebar');
    }
}

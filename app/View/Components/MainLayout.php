<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MainLayout extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public string $title ,public ?string $class= null )
    {
        //رح نمرر جواه ال attributes
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('layout.main');
    }
}

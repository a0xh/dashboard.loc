<?php

namespace App\Application\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Blade;

class Success extends Component
{
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return Blade::anonymousComponentPath(
            app_path() . '/Infrastructure/Views/components/success'
        );
    }
}

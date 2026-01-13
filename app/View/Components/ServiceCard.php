<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ServiceCard extends Component
{
    public $service;

    public function __construct($service)
    {
        $this->service = $service;
    }

    public function render(): View|Closure|string
    {
        return view('components.service-card');
    }
}

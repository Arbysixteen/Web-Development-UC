<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TestimonialCard extends Component
{
    public $testimonial;

    public function __construct($testimonial)
    {
        $this->testimonial = $testimonial;
    }

    public function render(): View|Closure|string
    {
        return view('components.testimonial-card');
    }
}

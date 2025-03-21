<?php

namespace App\View\Components\inquiry;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Inquiry;

class kanban6Component extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->inquiry = new Inquiry();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $data = $this->inquiry->getListCardInquiry('STATUS0006');
        return view('components.inquiry.kanban6-component', compact('data'));
    }
}

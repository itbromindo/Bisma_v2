<?php

namespace App\View\Components\inquiry;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Inquiry;
use App\Models\InquiryStatus;

class kanban2Component extends Component
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
        $inquiry_status_code = 'STATUS002';
        $inquiry = InquiryStatus::where('inquiry_status_code', $inquiry_status_code)->first();
        $data = $this->inquiry->getListCardInquiry($inquiry_status_code);
        return view('components.inquiry.kanban2-component', compact('data', 'inquiry'));
    }
}

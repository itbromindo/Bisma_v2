<?php

namespace App\View\Components\Inquiry;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Inquiry;
use App\Models\InquiryStatus;

class Kanban5Component extends Component
{
    public $search;

    public function __construct($search = null)
    {
        $this->inquiry = new Inquiry();
        $this->search = $search;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $inquiry_status_code = 'STATUS005';
        $inquiry = InquiryStatus::where('inquiry_status_code', $inquiry_status_code)->first();
        $data = $this->inquiry->getListCardInquiry($inquiry_status_code, $this->search);
        return view('components.inquiry.kanban5-component', compact('data', 'inquiry'));
    }
}

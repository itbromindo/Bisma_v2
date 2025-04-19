<?php

namespace App\View\Components\Inquiry;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Inquiry;
use App\Models\InquiryStatus;

class Kanban8Component extends Component
{
    public $search;
    public $filters;

    public function __construct($search, $filters = [])
    {
        $this->inquiry = new Inquiry();
        $this->search = $search;
        $this->filters = $filters;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $inquiry_status_code = 'STATUS008';
        $inquiry = InquiryStatus::where('inquiry_status_code', $inquiry_status_code)->first();
        $data = $this->inquiry->getListCardInquiry($inquiry_status_code, $this->search, $this->filters);
        return view('components.inquiry.kanban8-component', compact('data', 'inquiry'));
    }
}

<div class="card">
    <div class="card-body">
        <div class="kanban-board-header">
            <h5>{{ $inquiry->inquiry_status_name }}</h5>
        </div>
        <div id="task-inquiry-3" class="kanban-section">
            <div id="inquiry-3" class="kanban-column">
                <input type="hidden" value="{{ $inquiry->inquiry_status_code }}" class="inquiry-stage">
                @foreach($data as $row)
                @php
                    $duedate = $row->inquiry_end_date;
                    $today = date('Y-m-d H:i:s');
                    $status_card = '';

                    if($today > $duedate)
                    {
                        $status_card = ' bg-danger-50 border-danger';
                    }
                @endphp

                <div class="card-priority rt-mb-12 {{ $status_card }}">
                    <input type="hidden" value="{{ $row->inquiry_id }}" class="inquiry-id">
                    <!-- top bar  -->
                    <div class="card-priority__header">
                        <div class="date">
                            <span class="icon">
                                <img src="{{asset('backend/assets/images/svg/clock.svg')}}" alt="clock">
                            </span>
                            <p>Due Date Inquiry : <br>{{ date("d M, Y", strtotime($duedate)) }}</p>
                        </div>
                        <!-- actions  -->

                    </div>

                    <!-- labels  -->
                    <div class="card-priority__labels">
                        <ul>
                            <li>
                                <span class="badge rounded-pill bg-success-50 text-success-500"
                                >{{ $row->origin_inquiry_name }}</span>
                            </li>
                            @php
                                $product_divisions = $row->product_divisions_name;
                                $product_divisions = explode(',', $product_divisions);
                            @endphp
                            @foreach ($product_divisions as $divisi)
                            <li>
                                <span class="badge rounded-pill bg-primary-50 text-primary-500"
                                >{{ $divisi }}</span>
                            </li>
                            @endforeach
                            <li>
                                <span class="badge rounded-pill bg-warning-50 text-warning-500">{{ $row->inquiry_type_name }}</span>
                            </li>
                        </ul>
                    </div>

                    <h2 class="card-priority__title pointer">
                        {{ $row->inquiry_code }}
                    </h2>
                    <h3 class="card-priority__title pointer" style="font-size: 14px; color: #626C70; margin: 0;">{{ $row->customer_name }}</h3>

                    <!-- priority footer  -->
                    <div class="card-priority__footer">
                        <div>
                            <ul class="labels-info">
                                <li>
                                    <a href="#">
                                        <span>
                                            <img src="{{asset('backend/assets/images/svg/attach.svg')}}" alt="icon">
                                        </span> 5
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span>
                                            <img src="{{asset('backend/assets/images/svg/comments.svg')}}" alt="icon">
                                        </span> 19
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span>
                                            <img src="{{asset('backend/assets/images/svg/checks.svg')}}" alt="icon">
                                        </span> 19
                                    </a>
                                </li>
                                <li>
                                    <span class="labels urgent {{ $row->inquiry_stage_progress_color }}"
                                    >{{ ucwords($row->inquiry_stage_progress) }}</span>
                                </li>
                            </ul>
                        </div>
                        <div>
                            @php
                                $image = $row->users_photo;
                                $images = explode(',', $image);
                            @endphp
                            <ul class="users">
                                @foreach($images as $img)
                                <li class="users-item rounded-circle">
                                    <img src="{{ asset($img) }}" alt="user-photo">
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

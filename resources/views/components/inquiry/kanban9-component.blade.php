<div class="card">
    <div class="card-body">
        <div class="kanban-board-header">
            <h5>Inquiry Batal</h5>
        </div>
        <div id="task-inquiry-batal">
            <div id="inquiry-batal" class="kanban-column">
                <input type="hidden" value="STATUS0009" class="inquiry-stage">
                @foreach($data as $row)
                @php
                    $duedate = $row->inquiry_end_date;
                    $today = date('Y-m-d H:i:s');
                    $status_card = '';
                    
                    if($today > $duedate)
                    {
                        $status_card = 'bg-danger-50';
                    }
                @endphp
                <div class="card-priority rt-mb-12 {{ $status_card }}">
                    <input type="hidden" value="{{ $row->inquiry_id }}" class="inquiry-id">
                    <!-- top bar  -->
                    <div class="card-priority__header">
                        <div class="date">
                            <span class="icon">
                                <img
                                    src="{{asset('backend/assets/images/svg/clock.svg')}}"
                                    alt="clock"
                                />
                            </span>

                            <p>Due Date Inquiry : <br>{{ date("d M, Y", strtotime($duedate)) }}</p>
                        </div>
                        <!-- actions  -->
                        <div class="card-priority__actions">
                            <button class="dots-three text-gray-400 f-size-24 lh-1" type="button" id="dropdownMenuButton_1" data-bs-toggle="dropdown" aria-expanded="true">
                                <img src="{{asset('backend/assets/images/svg/dot.svg')}}" alt="clock" />
                            </button>
                            <ul class="dropdown-menu dropdown-actions" aria-labelledby="dropdownMenuButton_1" data-popper-placement="bottom-start">
                                <li>
                                    <a href="#" class="dropdown-item">
                                        <span>
                                            <img
                                            src="{{asset('backend/assets/images/svg/pen.svg')}}"
                                            alt="pen"
                                            />
                                        </span>
                                        Edit
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="dropdown-item remove-killer plain-btn">
                                        <span>
                                            <img
                                            src="{{asset('backend/assets/images/svg/trash.svg')}}"
                                            alt="trash"
                                            />
                                        </span>
                                        Delete
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- labels  -->
                    <div class="card-priority__labels">
                        <ul>
                            <li>
                                <span class="labels medium yellow">{{ $row->inquiry_type_name }}</span>
                            </li>
                        </ul>
                    </div>
                    <h2 class="card-priority__title pointer">
                        {{ $row->inquiry_code }}
                    </h2>
                    <p>{{ $row->customer_name }}</p>
                    @if(!empty($row->users_photo))
                    <!-- priority footer  -->
                    <div class="card-priority__footer">
                        <div>
                            <ul class="labels-info">
                                <li>
                                    <a href="#">
                                        <span>
                                        <img
                                            src="{{asset('backend/assets/images/svg/attach.svg')}}"
                                            alt="icon"
                                        />
                                        </span>
                                        5
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span>
                                        <img
                                            src="{{asset('backend/assets/images/svg/comments.svg')}}"
                                            alt="icon"
                                        />
                                        </span>
                                        19
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <ul>
                                <li>
                                    <span class="labels urgent {{ $row->inquiry_stage_progress_color }}"
                                    >{{ $row->inquiry_stage_progress }}</span>
                                </li>
                            </ul>
                        </div>
                        <div class="rt-mb-12">
                            @php
                                $image = $row->users_photo;
                                $images = explode(',', $image);
                            @endphp
                            <ul class="users">
                                @foreach($images as $img)
                                <li class="users-item">
                                    <img src="{{ $img }}" alt="user-photo">
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
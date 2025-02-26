<div class="card">
    <div class="card-body">
        <div class="kanban-board-header">
            <h5>Inquiry Masuk</h5>
            <div class="card-priority__actions">
                <button class="dots-three text-gray-400 f-size-24 lh-1" type="button" id="dropdownMenuButton5" data-bs-toggle="dropdown" aria-expanded="true">
                    <img src="{{ asset('backend/assets/images/svg/dot.svg') }}" alt="clock" />
                </button>
                <ul class="dropdown-menu dropdown-actions" aria-labelledby="dropdownMenuButton5" data-popper-placement="bottom-start">
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
                        <a href="#" class="dropdown-item">
                            <span>
                                <img
                                    src="{{asset('backend/assets/images/svg/copy-link.svg')}}"
                                    alt="copylink"
                                />
                            </span>
                            Copy Link
                        </a>
                    </li>
                    <li>
                        <a href="#" class="dropdown-item remove-killer plain-btn">
                            <span>
                                <img
                                    src="{{asset('backend/assets/images/svg/trash.svg')}}"
                                    alt="copylink"
                                />
                            </span>
                            Delete
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div id="task-1">
            <div id="todo">
                <div class="card-priority rt-mb-12">
                    <!-- top bar  -->
                    <div class="card-priority__header">
                        <div class="date">
                            <span class="icon">
                                <img
                                    src="{{asset('backend/assets/images/svg/clock.svg')}}"
                                    alt="clock"
                                />
                            </span>
                            <p>14 Nov, 2021</p>
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
                                    <a href="#" class="dropdown-item">
                                        <span>
                                            <img
                                            src="{{asset('backend/assets/images/svg/copy-link.svg')}}"
                                            alt="copylink"
                                            />
                                        </span>
                                        Copy Link
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="dropdown-item remove-killer plain-btn">
                                        <span>
                                            <img
                                            src="{{asset('backend/assets/images/svg/trash.svg')}}"
                                            alt="copylink"
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
                                <span class="labels medium"
                                >Medium Priority</span>
                            </li>
                            <li>
                                <span class="labels urgent"
                                ><img
                                class="rt-mr-6"
                                src="{{asset('backend/assets/images/svg/red-circle.svg')}}"
                                alt=""
                                />
                                Urgents</span>
                            </li>
                        </ul>
                    </div>
                    <h2 class="card-priority__title pointer">
                        Meeting with UI/UX Team to manage our upcoming
                        projects &amp; task.
                    </h2>
                    <!-- priority footer  -->
                    <div class="card-priority__footer">
                        <div>
                            <ul class="labels-info">
                                <li>
                                    <a href="#">
                                        <span>
                                            <img src="{{asset('backend/assets/images/svg/attach.svg')}}" alt="icon">
                                        </span>
                                        5
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span>
                                            <img src="{{asset('backend/assets/images/svg/comments.svg')}}" alt="icon">
                                        </span>
                                        19
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <ul class="users">
                                <li class="users-item">
                                    <img src="{{asset('backend/assets/images/all-img/users/user1.png')}}" alt="user-photo">
                                </li>
                                <li class="users-item">
                                    <img src="{{asset('backend/assets/images/all-img/users/three.png')}}" alt="user-photo">
                                </li>
                                <li class="users-item">
                                    <img src="{{asset('backend/assets/images/all-img/users/two.png')}}" alt="user-photo">
                                </li>
                                <li class="users-item">
                                    <img src="{{asset('backend/assets/images/all-img/users/one.png')}}" alt="user-photo">
                                </li>
                            </ul>
                        </div>
                    </div>
                    </div>
                    <div class="card-priority rt-mb-12">
                    <!-- top bar  -->
                    <div class="card-priority__header">
                        <div class="date">
                        <span class="icon">
                        <img
                            src="{{asset('backend/assets/images/svg/clock.svg')}}"
                            alt="clock"
                        />
                        </span>
                        <p>14 Nov, 2021</p>
                        </div>
                        <!-- actions  -->
                        <div class="card-priority__actions">
                        <button class="dots-three text-gray-400 f-size-24 lh-1" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="true">
                            <img src="{{asset('backend/assets/images/svg/dot.svg')}}" alt="clock" />
                        </button>
                        <ul class="dropdown-menu dropdown-actions" aria-labelledby="dropdownMenuButton2" data-popper-placement="bottom-start">
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
                            <a href="#" class="dropdown-item">
                                <span>
                                <img
                                src="{{asset('backend/assets/images/svg/copy-link.svg')}}"
                                alt="copylink"
                                />
                            </span>
                                Copy Link
                            </a>
                            </li>
                            <li>
                            <a href="#" type="button" class="dropdown-item remove-killer plain-btn">
                                <span>
                                <img
                                src="{{asset('backend/assets/images/svg/trash.svg')}}"
                                alt="copylink"
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
                            <span class="labels red"
                            >High Priority</span>
                        </li>
                        <li>
                            <span class="labels urgent green"
                            ><img
                            class="rt-mr-6"
                            src="{{asset('backend/assets/images/svg/circle-green.svg')}}"
                            alt=""
                            />
                            Work</span>
                        </li>
                        </ul>
                    </div>
                    <h2 class="card-priority__title pointer">
                        New Project Idea & UX Research
                    </h2>
                    <!-- priority footer  -->
                    <div class="card-priority__footer">
                        <div>
                        <ul class="labels-info">
                            <li>
                            <a href="#">
                                <span>
                            <img src="{{asset('backend/assets/images/svg/attach.svg')}}" alt="icon">
                            </span>
                                5
                            </a>
                            </li>
                            <li>
                            <a href="#">
                                <span>
                            <img src="{{asset('backend/assets/images/svg/comments.svg')}}" alt="icon">
                            </span>
                                19
                            </a>
                            </li>
                        </ul>
                        </div>
                        <div>
                        <ul class="users">
                            <li class="users-item">
                            <img src="{{asset('backend/assets/images/all-img/users/user1.png')}}" alt="user-photo">
                            </li>
                            <li class="users-item">
                            <img src="{{asset('backend/assets/images/all-img/users/three.png')}}" alt="user-photo">
                            </li>
                            <li class="users-item">
                            <img src="{{asset('backend/assets/images/all-img/users/two.png')}}" alt="user-photo">
                            </li>
                            <li class="users-item">
                            <img src="{{asset('backend/assets/images/all-img/users/one.png')}}" alt="user-photo">
                            </li>
                        </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="add-new-card-btn">
            <button type="button" class="btn btn-primary2 waves-effect primary-dark pill btn-icon d-block" id="toboad_task" name="button-group">
                <span class="button-content-wrapper">
                    <span class="button-icon align-icon-left">
                        <i class="ph-plus"></i>
                    </span>
                    <span class="button-text"> Tambah Inquiry </span>
                </span>
            </button>
        </div>
    </div>
</div>

<input type="hidden" id="kanban1_inquiry_active" value="kanban1_inquiry_active">

<script>
    function inquiryactive(kodeval){
        $('#supply-only').removeClass('active');
        $('#project').removeClass('active');
        $('#refill').removeClass('active');
        $('#servis').removeClass('active');
        $('#info-harga').removeClass('active');

        $('#'+kodeval).addClass('active');
        $('#kanban1_inquiry_active').val(kodeval);
    }

    function saveinquiry_active(){
        var inquiry_active = $('#kanban1_inquiry_active').val();
        // open route to save inquiry active with a herf
        if(inquiry_active == 'supply-only'){
            window.location.href = '/admin/inquiry_supply_only';
        }else if(inquiry_active == 'project'){
            window.location.href = '/admin/inquiry_project';
        }else if(inquiry_active == 'refill'){
            window.location.href = '/admin/inquiry_refill';
        }else if(inquiry_active == 'servis'){
            window.location.href = '/admin/inquiry_servis';
        }else if(inquiry_active == 'info-harga'){
            window.location.href = '/admin/inquiry_info_harga';
        }
    }
</script>
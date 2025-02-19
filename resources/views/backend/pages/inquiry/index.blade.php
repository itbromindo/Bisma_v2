@extends('backend.layouts.master')

@section('title')
Inquiry - Admin Panel
@endsection

@php
    $usr = Auth::guard('web')->user();
@endphp

@section('admin-content')
<div class="content-wrapper">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 rt-mb-25">
                    <div class="breadcrumbs">
                        <div class="breadcrumb-title">Inquiry</div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href='/admin'>Home</a></li>
                                <li class="breadcrumb-item"><a href='/admin/inquiry'>Origin</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><a href='/admin/inquiry'>Inquiry</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- kanban start-->
            <div class="row">
                <div class="col-12">
                <div id="board" class="board">
                    <div class="d-flex kanbanboard_parent" id="kanban_board_parent">
                    <div class="kanbanboard_child">
                        <div class="card">
                        <div class="card-body">
                            <div class="kanban-board-header">
                            <h5>To-do</h5>
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
                                <span class="button-text"> Add new card </span>
                                </span>
                            </button>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="kanbanboard_child">
                        <div class="card">
                        <div class="card-body">
                            <div class="kanban-board-header">
                            <h5>Doing</h5>
                            <div class="card-priority__actions">
                                <button class="dots-three text-gray-400 f-size-24 lh-1" type="button" id="dropdownMenuButton6" data-bs-toggle="dropdown" aria-expanded="true">
                                <img src="{{asset('backend/assets/images/svg/dot.svg')}}" alt="clock" />
                                </button>
                                <ul class="dropdown-menu dropdown-actions" aria-labelledby="dropdownMenuButton6" data-popper-placement="bottom-start">
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
                            <div id="task-2">
                            <div id="doing">
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
                                    <button class="dots-three text-gray-400 f-size-24 lh-1" type="button" id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="true">
                                        <img src="{{asset('backend/assets/images/svg/dot.svg')}}" alt="clock" />
                                    </button>
                                    <ul class="dropdown-menu dropdown-actions" aria-labelledby="dropdownMenuButton3" data-popper-placement="bottom-start">
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

                                <div class="card-priority-thumb">
                                    <img src="{{asset('backend/assets/images/all-img/kanban-thumb.jpg')}}" alt="">
                                </div>

                                <!-- labels  -->
                                <div class="card-priority__labels">
                                    <ul>
                                    <li>
                                        <span class="labels medium yellow"
                                        >Not Inportant</span>
                                    </li>
                                    <li>
                                        <span class="labels urgent blue"
                                        ><img
                                        class="rt-mr-6"
                                        src="{{asset('backend/assets/images/svg/circle-blue.svg')}}"
                                        alt=""
                                        />
                                        Personal</span>
                                    </li>
                                    </ul>
                                </div>
                                <h2 class="card-priority__title pointer">
                                    Buy Green Plants for my Desk.
                                </h2>

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
                                    <button class="dots-three text-gray-400 f-size-24 lh-1" type="button" id="dropdownMenuButton10" data-bs-toggle="dropdown" aria-expanded="true">
                                        <img src="{{asset('backend/assets/images/svg/dot.svg')}}" alt="clock" />
                                    </button>
                                    <ul class="dropdown-menu dropdown-actions" aria-labelledby="dropdownMenuButton10" data-popper-placement="bottom-start">
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
                                        <span class="labels urgent blue"
                                        ><img
                                        class="rt-mr-6"
                                        src="{{asset('backend/assets/images/svg/circle-blue.svg')}}"
                                        alt=""
                                        />
                                        Personal</span>
                                    </li>
                                    </ul>
                                </div>
                                <h2 class="card-priority__title pointer">
                                    Buy Flowers for my love
                                </h2>

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
                                    <button class="dots-three text-gray-400 f-size-24 lh-1" type="button" id="dropdownMenuButton11" data-bs-toggle="dropdown" aria-expanded="true">
                                        <img src="{{asset('backend/assets/images/svg/dot.svg')}}" alt="clock" />
                                    </button>
                                    <ul class="dropdown-menu dropdown-actions" aria-labelledby="dropdownMenuButton11" data-popper-placement="bottom-start">
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
                                        <span class="labels urgent yellow"
                                        ><img
                                        class="rt-mr-6"
                                        src="{{asset('backend/assets/images/svg/circle-yellow.svg')}}"
                                        alt=""
                                        />
                                        Productivity</span>
                                    </li>
                                    </ul>
                                </div>
                                <h2 class="card-priority__title pointer">
                                    Learn how to work with kanban board.
                                </h2>
                                <!-- priority footer  -->
                                <div class="card-priority__footer">
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
                            <button type="button" class="btn btn-primary2 waves-effect primary-dark pill btn-icon d-block" id="doingboard_task" name="button-group">
                                <span class="button-content-wrapper">
                                <span class="button-icon align-icon-left">
                                <i class="ph-plus"></i>
                                </span>
                                <span class="button-text"> Add new card </span>
                                </span>
                            </button>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="kanbanboard_child">
                        <div class="card">
                        <div class="card-body">
                            <div class="kanban-board-header">
                            <h5>Done</h5>
                            <div class="card-priority__actions">
                                <button class="dots-three text-gray-400 f-size-24 lh-1" type="button" id="dropdownMenuButton7" data-bs-toggle="dropdown" aria-expanded="true">
                                <img src="{{asset('backend/assets/images/svg/dot.svg')}}" alt="clock" />
                                </button>
                                <ul class="dropdown-menu dropdown-actions" aria-labelledby="dropdownMenuButton7" data-popper-placement="bottom-start">
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
                            <div id="task-3">
                            <div id="done">
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
                                    <button class="dots-three text-gray-400 f-size-24 lh-1" type="button" id="dropdownMenuButton4" data-bs-toggle="dropdown" aria-expanded="true">
                                        <img src="{{asset('backend/assets/images/svg/dot.svg')}}" alt="clock" />
                                    </button>
                                    <ul class="dropdown-menu dropdown-actions" aria-labelledby="dropdownMenuButton4" data-popper-placement="bottom-start">
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
                                        <span class="labels medium"
                                        >Medium Priority</span>
                                    </li>
                                    <li>
                                        <span class="labels urgent green"
                                        ><img
                                        class="rt-mr-6"
                                        src="{{asset('backend/assets/images/svg/circle-green.svg')}}"
                                        alt=""
                                        />
                                        Productivity</span>
                                    </li>
                                    </ul>
                                </div>
                                <h2 class="card-priority__title pointer">
                                    Learn how to work with kanban board.
                                </h2>
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
                                    <button class="dots-three text-gray-400 f-size-24 lh-1" type="button" id="dropdownMenuButton8" data-bs-toggle="dropdown" aria-expanded="true">
                                        <img src="{{asset('backend/assets/images/svg/dot.svg')}}" alt="clock" />
                                    </button>
                                    <ul class="dropdown-menu dropdown-actions" aria-labelledby="dropdownMenuButton8" data-popper-placement="bottom-start">
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

                                <div class="card-priority-thumb">
                                    <img src="{{asset('backend/assets/images/all-img/kanban-thumb2.jpg')}}" alt="">
                                </div>

                                <!-- labels  -->
                                <div class="card-priority__labels">
                                    <ul>
                                    <li>
                                        <span class="labels red"
                                        >High Priority</span>
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
                                    Buy Green Plants for my Desk.
                                </h2>

                                </div>
                            </div>
                            </div>
                            <div class="add-new-card-btn">
                            <button type="button" class="btn btn-primary2 waves-effect primary-dark pill btn-icon d-block" id="done_task" name="button-group">
                                <span class="button-content-wrapper">
                                <span class="button-icon align-icon-left">
                                <i class="ph-plus"></i>
                                </span>
                                <span class="button-text"> Add new card </span>
                                </span>
                            </button>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="kanbanboard_child">
                        <div class="card">
                        <button class="plain-btn add-new-column text-primary-500 font-semibold" data-bs-toggle="modal" data-bs-target="#createboard-modal">
                            <span>
                            <svg
                                width="21"
                                height="20"
                                viewBox="0 0 21 20"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                d="M11.0625 9.375V9.4375H11.125H17.375C17.5242 9.4375 17.6673 9.49676 17.7727 9.60225C17.8782 9.70774 17.9375 9.85082 17.9375 10C17.9375 10.1492 17.8782 10.2923 17.7727 10.3977C17.6673 10.5032 17.5242 10.5625 17.375 10.5625H11.125H11.0625V10.625V16.875C11.0625 17.0242 11.0032 17.1673 10.8977 17.2727C10.7923 17.3782 10.6492 17.4375 10.5 17.4375C10.3508 17.4375 10.2077 17.3782 10.1023 17.2727C9.99676 17.1673 9.9375 17.0242 9.9375 16.875V10.625V10.5625H9.875H3.625C3.47582 10.5625 3.33274 10.5032 3.22725 10.3977C3.12176 10.2923 3.0625 10.1492 3.0625 10C3.0625 9.85082 3.12176 9.70774 3.22725 9.60225C3.33274 9.49676 3.47582 9.4375 3.625 9.4375H9.875H9.9375V9.375V3.125C9.9375 2.97582 9.99676 2.83274 10.1023 2.72725C10.2077 2.62176 10.3508 2.5625 10.5 2.5625C10.6492 2.5625 10.7923 2.62176 10.8977 2.72725C11.0032 2.83274 11.0625 2.97582 11.0625 3.125V9.375Z"
                                fill="#005CE8"
                                stroke="#005CE8"
                                stroke-width="0.125"
                                />
                            </svg> </span>Add new Column
                        </button>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            <!-- kanban end -->

        </div>
    </div>
</div>

@endsection

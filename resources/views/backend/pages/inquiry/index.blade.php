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
                        <div class="d-flex justify-content-end my-2">
                            <button type="button" class="btn btn-sm btn-outline-primary pill btn-icon">
                                <span class="button-content-wrapper">
                                    <span class="button-text">
                                        Button
                                    </span>
                                    <span class="button-icon">
                                        <img src="{{ asset('backend/assets/images/svg/search.svg')}}" alt="Search" draggable="false">
                                    </span>
                                </span>
                            </button>
                            <button type="button" class="btn btn-icon">
                                <span class="button-content-wrapper">
                                    <span class="button-icon">
                                        <img src="{{ asset('backend/assets/images/svg/search.svg')}}" alt="Search" draggable="false">
                                    </span>
                                </span>
                            </button>
                        </div>

                        <div class="d-flex kanbanboard_parent" id="kanban_board_parent">
                            @if ($usr->can('inquiry.kanban1'))
                                <div class="kanbanboard_child">
                                    <x-inquiry.kanban1-component />
                                </div>
                            @endif
                            @if ($usr->can('inquiry.kanban2'))
                                <div class="kanbanboard_child">
                                    <x-inquiry.kanban2-component />
                                </div>
                            @endif
                            @if ($usr->can('inquiry.kanban3'))
                                <div class="kanbanboard_child">
                                    <x-inquiry.kanban3-component />
                                </div>
                            @endif
                            @if ($usr->can('inquiry.kanban4'))
                                <div class="kanbanboard_child">
                                    <x-inquiry.kanban4-component />
                                </div>
                            @endif
                            @if ($usr->can('inquiry.kanban5'))
                                <div class="kanbanboard_child">
                                    <x-inquiry.kanban5-component />
                                </div>
                            @endif
                            @if ($usr->can('inquiry.kanban6'))
                                <div class="kanbanboard_child">
                                    <x-inquiry.kanban6-component />
                                </div>
                            @endif
                            @if ($usr->can('inquiry.kanban7'))
                                <div class="kanbanboard_child">
                                    <x-inquiry.kanban7-component />
                                </div>
                            @endif
                            @if ($usr->can('inquiry.kanban8'))
                                <div class="kanbanboard_child">
                                    <x-inquiry.kanban8-component />
                                </div>
                            @endif
                            @if ($usr->can('inquiry.kanban9'))
                                <div class="kanbanboard_child">
                                    <x-inquiry.kanban9-component />
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- kanban end -->

        </div>
    </div>
</div>

<style>
    .kanban-container {
        display: flex;
        gap: 20px;
        padding: 20px;
    }

    .kanban-column {
        min-height: 200px;
    }

    .card-priority {
        cursor: grab;
    }

</style>

@endsection

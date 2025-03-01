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
                                <x-inquiry.kanban1-component />
                            </div>
                            <div class="kanbanboard_child">
                                <x-inquiry.kanban2-component />
                            </div>
                            <div class="kanbanboard_child">
                                <x-inquiry.kanban3-component />
                            </div>
                            <div class="kanbanboard_child">
                                <x-inquiry.kanban4-component />
                            </div>
                            <div class="kanbanboard_child">
                                <x-inquiry.kanban5-component />
                            </div>
                            <div class="kanbanboard_child">
                                <x-inquiry.kanban5-component />
                            </div>
                            <div class="kanbanboard_child">
                                <x-inquiry.kanban6-component />
                            </div>
                            <div class="kanbanboard_child">
                                <x-inquiry.kanban7-component />
                            </div>
                            <div class="kanbanboard_child">
                                <x-inquiry.kanban8-component />
                            </div>
                            <div class="kanbanboard_child">
                                <x-inquiry.kanban9-component />
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

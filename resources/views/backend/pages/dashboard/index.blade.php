
@extends('backend.layouts.master')

@section('title')
Dashboard Page - Bromindo
@endsection


@section('admin-content')

@php
    $user = session('user_name');
@endphp

<div class="content-wrapper">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 rt-mb-25">
                    <div class="page-title body-font-3 font-semibold">
                        <span class="inline-block rt-mr-5">👋</span> Hey, {{ $user }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
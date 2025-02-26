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


            <div class="row">
                <div class="col-xxl-6 col-xl-6 col-md-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5>Detail Customer</h5>
                        </div>

                        <div class="card-body">

                        </div>
                    </div>
                </div>

                <div class="col-xxl-6 col-xl-6 col-md-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5>Informasi Permintaan</h5>
                        </div>

                        <div class="card-body">

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xxl-12 col-xl-12 col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5>List Permintaan</h5>
                            <div class="d-flex align-items-center">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalinput" onclick="clearform()">Tambah Data</button>
                            </div>
                        </div>

                        <div class="card-body">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xxl-12 col-xl-12 col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5>Keterangan</h5>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

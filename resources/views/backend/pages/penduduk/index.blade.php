
@extends('backend.layouts.master')

@section('title')
{{ __('Penduduk - Admin Panel') }}
@endsection

@section('styles')
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
@endsection

@section('admin-content')

<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">{{ __('Data Penduduk') }}</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
                    <li><span>{{ __('All Data Penduduk') }}</span></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6 clearfix">
            @include('backend.layouts.partials.logout')
        </div>
    </div>
</div>
<!-- page title area end -->

<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title float-left">{{ __('Admins') }}</h4>
                    <p class="float-right mb-2">
                        @if (auth()->user()->can('penduduk.edit'))
                            <a class="btn btn-primary text-white" href="{{ route('admin.penduduk.create') }}">
                                {{ __('Create New Data Penduduk') }}
                            </a>
                        @endif
                        @if (auth()->user()->can('penduduk.importexcel'))
                            <a class="btn btn-primary text-white" href="{{ route('admin.penduduk.importexcel') }}">
                                {{ __('Import Data Penduduk') }}
                            </a>
                        @endif
                        @if (auth()->user()->can('penduduk.exportexcel'))
                            <a class="btn btn-primary text-white" href="{{ route('admin.penduduk.export') }}">
                                {{ __('Export Data Penduduk') }}
                            </a>
                        @endif
                    </p>
                    <div class="clearfix"></div>
                    <div class="data-tables">
                        @include('backend.layouts.partials.messages')
                        <table id="dataTable" class="text-center">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th width="5%">{{ __('Sl') }}</th>
                                    <th width="10%">{{ __('NIK') }}</th>
                                    <th width="10%">{{ __('Nama') }}</th>
                                    <th width="40%">{{ __('Tempat Lahir') }}</th>
                                    <th width="40%">{{ __('Tanggal Lahir') }}</th>
                                    <th width="15%">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($listdata as $data)
                               <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $data->penNik }}</td>
                                    <td>{{ $data->penNama }}</td>
                                    <td>{{ $data->penTempatLahir}}</td>
                                    <td>{{ $data->penTglLahir}}</td>
                                    <td>
                                        @if (auth()->user()->can('penduduk.edit'))
                                            <a class="btn btn-success text-white" href="{{ route('admin.penduduk.edit', $data->penId) }}">Edit</a>
                                        @endif
                                        
                                        @if (auth()->user()->can('penduduk.delete'))
                                        <a class="btn btn-danger text-white" href="javascript:void(0);"
                                        onclick="event.preventDefault(); if(confirm('Are you sure you want to delete?')) { document.getElementById('delete-form-{{ $data->penId }}').submit(); }">
                                            {{ __('Delete') }}
                                        </a>

                                        <form id="delete-form-{{ $data->penId }}" action="{{ route('admin.penduduk.destroy', $data->penId) }}" method="POST" style="display: none;">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                               @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- data table end -->
    </div>
</div>
@endsection

@section('scripts')
     <!-- Start datatable js -->
     <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
     <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
     <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
     <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
     <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
     
     <script>
        if ($('#dataTable').length) {
            $('#dataTable').DataTable({
                responsive: true
            });
        }
     </script>
@endsection
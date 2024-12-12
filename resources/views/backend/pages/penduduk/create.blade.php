
@extends('backend.layouts.master')

@section('title')
Data Penduduk Create - Admin Panel
@endsection

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

<style>
    .form-check-label {
        text-transform: capitalize;
    }
</style>
@endsection


@section('admin-content')

<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Data Penduduk Create</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('admin.admins.index') }}">All Admins</a></li>
                    <li><span>Create Data Penduduk</span></li>
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
                    <h4 class="header-title">Create New Data Penduduk</h4>
                    @include('backend.layouts.partials.messages')
                    
                    <form action="{{ route('admin.penduduk.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="penNik">NIK</label>
                                <input type="text" class="form-control" id="penNik" name="penNik" placeholder="auto create nik" required autofocus value="{{$nonik}}" readonly>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="penNama">Nama</label>
                                <input type="text" class="form-control" id="penNama" name="penNama" placeholder="Enter Nama" required value="{{ old('penNama') }}">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="penTempatLahir">Tempat Lahir</label>
                                <input type="text" class="form-control" id="penTempatLahir" name="penTempatLahir" placeholder="Enter Tempat Lahir" required>
                            </div>
                            <div class="form-group col-md-4 col-sm-12">
                                <label for="penTglLahir">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="penTglLahir" name="penTglLahir" placeholder="Enter Tanggal" required>
                            </div>
                            <div class="form-group col-md-2 col-sm-12">
                                <label for="penTglLahir">Umur</label>
                                <input type="text" class="form-control" id="umur" name="umur" placeholder="Umur" required readonly>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="penImage">FOTO</label>
                                <input type="file" class="form-control" id="penImage" name="penImage" placeholder="Enter Foto" required>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save</button>
                        <a href="{{ route('admin.penduduk.index') }}" class="btn btn-secondary mt-4 pr-4 pl-4">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
        <!-- data table end -->
        
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    })

    document.getElementById('penTglLahir').addEventListener('change', function() {
        const birthDate = new Date(this.value);
        const today = new Date();

        let years = today.getFullYear() - birthDate.getFullYear();
        let months = today.getMonth() - birthDate.getMonth();
        let days = today.getDate() - birthDate.getDate();

        if (months < 0) {
            years--;
            months += 12;
        }

        if (days < 0) {
            months--;
            const lastMonth = new Date(today.getFullYear(), today.getMonth(), 0);
            days += lastMonth.getDate();
        }

        document.getElementById('umur').value = `${years} tahun, ${months} bulan, ${days} hari`;
    });
</script>
@endsection
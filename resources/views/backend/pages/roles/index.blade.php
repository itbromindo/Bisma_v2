
@extends('backend.layouts.master')

@section('title')
{{ __('Roles & Permission - Admin Panel') }}
@endsection

@section('admin-content')
<style>
    /* Membatasi isi kolom permission agar tetap sesuai */
    .permission-container {
        display: flex;
        flex-wrap: wrap; /* Membuat item dalam kolom permission tetap berada di dalam */
        gap: 5px; /* Jarak antar badge */
        max-width: 100%; /* Menyesuaikan dengan lebar kolom */
        overflow: hidden; /* Memotong jika isi terlalu panjang */
        white-space: nowrap; /* Mencegah teks melar */
        text-overflow: ellipsis; /* Memberikan efek ... jika terlalu panjang */
    }

    /* Gaya untuk badge permission */
    .permission-item {
        background-color: #007bff; /* Warna biru */
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 0.85rem;
        text-align: center;
    }

</style>
<div class="content-wrapper">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 rt-mb-25">
                    <div class="breadcrumbs ">
                        <div class="breadcrumb-title"> Account Setting</div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href='/admin'>Home</a></li>
                                <li class="breadcrumb-item"><a href='/admin'>Setting</a></li>
                                <li class="breadcrumb-item active" aria-current="page"> Rele & Permission</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xxl-12 col-xl-12 col-md-12">
                    <section class="tables">
                        <p class="float-right mb-2">
                            <a href="{{ route('admin.permission.create') }}">
                                <button type="button" class="btn btn-primary pill mt-3">
                                    Tambah Role
                                </button>
                            </a>
                        </p>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-wrapper">
                                    <div class="table-content table-responsive">
                                        <table class="table align-middle table-basic ">
                                            <thead style="text-align: center">
                                                <tr>
                                                    <th scope="col" style="width: 5%;">No</th>
                                                    <th scope="col" style="width: 10%;">Name</th>
                                                    <th scope="col" style="width: 80%;">Permission</th>
                                                    <th scope="col" style="width: 5%;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($roles as $role)
                                                    <tr>
                                                        <td scope="row">{{ $loop->index+1 }}</td>
                                                        <td>{{ $role->name }}</td>
                                                        <td>
                                                            <div class="permission-container">
                                                                @foreach ($role->permissions as $permission)
                                                                    <span class="badge badge-primary permission-item">
                                                                        {{ $permission->name }}
                                                                    </span>
                                                                @endforeach
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <ul class="action-btn">
                                                                <li>
                                                                    <button onclick="delete_data('{{ $role->id }}')">
                                                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M12.5 3.5L3.5 12.5" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                            <path d="M12.5 12.5L3.5 3.5" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                        </svg>
                                                                    </button>
                                                                </li>
                                                                <li>
                                                                    <a href="{{ route('admin.permission.edit', $role->id) }}">
                                                                        <button title="Edit">
                                                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                <path d="M12.1464 1.85355C12.3417 1.65829 12.6583 1.65829 12.8536 1.85355L14.1464 3.14645C14.3417 3.34171 14.3417 3.65829 14.1464 3.85355L5.35355 12.6464L2.5 13.5L3.35355 10.6464L12.1464 1.85355Z" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                                <path d="M11.5 2.5L13.5 4.5" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                            </svg>
                                                                        </button>
                                                                    </a>
                                                                </li>

                                                            </ul>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    function delete_data(id){
        var postdata = {};
        postdata._token = document.getElementsByName('_token')[0].defaultValue;
        
        if (confirm('Apakah Anda Yakin Menghapus Data Ini?')) {
            $.ajax({
                type: "DELETE",
                url: "/admin/permission/"+id,
                data: (postdata),
                dataType: "json",
                async: false,
                success: function (data) {
                    if (data.status == 401) {
                        alert('Form Wajib Harus diisi');
                        return;
                    } else if (data.status == 501) {
                        alert(data.message);
                        return;
                    } else {
                        alert('Data Berhasil Dihapus');
                        setTimeout(function () {
                            window.open("/admin/permission", "_self");
                        }, 500);
                    }
                },
                error: function (dataerror) {
                    console.log(dataerror);
                }
            });
        }
    }

</script>
@endsection
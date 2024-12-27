
@extends('backend.layouts.master')

@section('title')
Kategori Customer - Admin Panel
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
                    <div class="breadcrumbs ">
                        <div class="breadcrumb-title"> Master</div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href='/admin'>Home</a></li>
                                <li class="breadcrumb-item"><a href='/admin'>Master</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Kategori Customer</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xxl-12 col-xl-12 col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5>Master Kategori Customer</h5>
                            <div class="d-flex align-items-center">
                                <div class="app-main-search me-2">
                                    <form action="/admin/customer_category" method="GET" class="d-flex">
                                        <div class="input-box d-flex">
                                            <input type="text" name="search" id="search" value="{{$search ?? ''}}" class="form-control" placeholder="Search Here">
                                            <button type="submit" class="btn btn-light ms-2">
                                                <img src="{{ asset('backend/assets/images/svg/search.svg')}}" alt="Search" draggable="false">
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                @if ($usr->can('customer_category.create'))
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalinput" onclick="clearform()">Tambah Data</button>
                                @endif
                            </div>
                        </div>

                        <div class="card-body">
                            <section class="tables">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="table-wrapper">
                                            <div class="table-content table-responsive">
                                                <table class="table align-middle table-basic ">
                                                    <thead style="text-align: center">
                                                        <tr>
                                                            <th scope="col">NO</th>
                                                            <th scope="col">NAME</th>
                                                            <th scope="col">NOTE</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tableBody">
                                                        @foreach ($customer_category as $ccy)
                                                            <tr>
                                                                <td scope="row" class="text-center">{{ $loop->index+1 }}</td>
                                                                <td>{{ $ccy->customer_category_name }}</td>
                                                                <td>{{ $ccy->customer_category_notes }}</td>
                                                                <td class="text-center">
                                                                    <div class="d-flex justify-content-center gap-2">
                                                                        <!-- Tombol Delete -->
                                                                        @if ($usr->can('customer_category.delete'))
                                                                        <button class="btn btn-light btn-sm border border-danger text-danger" title="Delete" onclick="delete_data('{{ $ccy->customer_category_id }}')">
                                                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                <path d="M12.5 3.5L3.5 12.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                                <path d="M12.5 12.5L3.5 3.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                            </svg>
                                                                        </button>
                                                                        @endif
                                                                        <!-- Tombol Edit -->
                                                                        <button class="btn btn-light btn-sm border border-success text-success" title="Edit" onclick="showedit('{{ $ccy->customer_category_id }}')">
                                                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                <path d="M12.1464 1.85355C12.3417 1.65829 12.6583 1.65829 12.8536 1.85355L14.1464 3.14645C14.3417 3.34171 14.3417 3.65829 14.1464 3.85355L5.35355 12.6464L2.5 13.5L3.35355 10.6464L12.1464 1.85355Z" stroke="green" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                                <path d="M11.5 2.5L13.5 4.5" stroke="green" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                            </svg>
                                                                        </button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Pagination -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <nav aria-label="Page navigation">
                                            <ul class="pagination justify-content-end">
                                                <!-- Previous Page Link -->
                                                <li class="page-item {{ $customer_category->onFirstPage() ? 'disabled' : '' }}">
                                                    <a class="page-link" href="{{ $customer_category->appends(['search' => $search ?? request('search')])->previousPageUrl() }}" aria-label="Previous">
                                                        <i class="ph-arrow-left"></i>
                                                    </a>
                                                </li>

                                                <!-- Page Number Links -->
                                                @foreach ($customer_category->onEachSide(0)->appends(['search' => $search ?? request('search')])->links()->elements[0] as $page => $url)
                                                    <li class="page-item {{ $customer_category->currentPage() == $page ? 'active' : '' }}">
                                                        <a class="page-link" href="{{ $url }}">{{ sprintf('%02d', $page) }}</a>
                                                    </li>
                                                @endforeach

                                                <!-- Next Page Link -->
                                                <li class="page-item {{ $customer_category->hasMorePages() ? '' : 'disabled' }}">
                                                    <a class="page-link" href="{{ $customer_category->appends(['search' => $search ?? request('search')])->nextPageUrl() }}" aria-label="Next">
                                                        <i class="ph-arrow-right"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalinput" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tittleform">Form Input</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" id="customer_category_id">
                    <div id="alert-container"></div> <!-- Tempat Alert -->
                    <div class="fromGroup mb-3">
                        <label>Nama</label>
                        <input class="form-control" type="text" id="customer_category_name" placeholder="Nama Kategori Customer" />
                    </div>
                    <div class="fromGroup mb-3">
                        <label>Note</label>
                        <textarea class="form-control" name="customer_category_notes" id="customer_category_notes" placeholder="Catatan"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-warning" onclick="clearform()">Clear Data</button>
                @if ($usr->can('customer_category.update') || $usr->can('customer_category.create'))
                <button type="button" class="btn btn-primary" onclick="save()">Save</button>
                @endif
            </div>
        </div>
    </div>
</div>
<script>

    function reload(){
        // setTimeout(function () {
            window.open("/admin/customer_category", "_self");
        // }, 500);
    }

    function save() {
        id = document.getElementById('customer_category_id').value;
        if (id == '') {
            saveInput();
        } else {
            updateInput(id);
        }
    }

    function clearform() {
        document.getElementById('customer_category_id').value = '';
        document.getElementById('customer_category_name').value = '';
        document.getElementById('customer_category_notes').value = '';

        document.getElementById('tittleform').innerHTML = 'Form Input';
    }

    function saveInput() {
        var postdata = new FormData();
        // Tambahkan token CSRF
        postdata.append('_token', document.getElementsByName('_token')[0].defaultValue);
        postdata.append('customer_category_name', document.getElementById('customer_category_name').value); 
        postdata.append('customer_category_notes', document.getElementById('customer_category_notes').value); 

        $.ajax({
            type: "POST",
            url: "/admin/customer_category",
            data: (postdata),
            processData: false, // Jangan ubah data
            contentType: false, // Atur tipe konten secara otomatis
            dataType: "json",
            async: false,
            success: function (data) {
                // console.log('hasil => ',data);
                
                if (data.status == 401) {
                    // alert('Form Wajib Harus diisi');
                    showAlert('danger', data.data);
                    return;
                } else if (data.status == 501) {
                    // alert(data.message);
                    showAlert('danger', data.data);
                    return;
                } else {
                    // alert('Berhasil Disimpan');
                    showAlert('success', 'Berhasil disimpan');
                    setTimeout(function () {
                        window.open("/admin/customer_category", "_self");
                    }, 500);
                }
            },
            error: function (dataerror) {
                console.log(dataerror);
                showAlert('danger', ['Terjadi kesalahan pada server']);
            }
        });

    }

    function showedit(id){
        $.ajax({
            type: "GET",
            url: "/admin/customer_category/"+id,
            dataType: "json",
            async: false,
            success: function (data) {
                // console.log('hasil => ',data);
                document.getElementById('customer_category_id').value = data.customer_category_id; 
                document.getElementById('customer_category_name').value = data.customer_category_name; 
                document.getElementById('customer_category_notes').value = data.customer_category_notes;

                document.getElementById('tittleform').innerHTML = 'Form Detail & Edit';
                // Tampilkan modal
                $('#modalinput').modal('show')
            },
            error: function (dataerror) {
                console.log(dataerror);
            }
        });
    }

    function updateInput(id) {
        var postdata = new FormData();
        // Tambahkan token CSRF
        postdata.append('_token', document.getElementsByName('_token')[0].defaultValue);
        postdata.append('customer_category_name', document.getElementById('customer_category_name').value); 
        postdata.append('customer_category_notes', document.getElementById('customer_category_notes').value); 
        // console.log('Data FormData: ', Array.from(postdata.entries()));
        

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            type: "POST",
            url: "/admin/customer_category/"+id,
            data: (postdata),
            processData: false, // Jangan ubah data
            contentType: false, // Atur tipe konten secara otomatis
            dataType: "json",
            async: false,
            success: function (data) {
                // console.log('hasil => ',data);
                
                if (data.status == 401) {
                    // alert('Form Wajib Harus diisi');
                    showAlert('danger', data.data);
                    return;
                } else if (data.status == 501) {
                    // alert(data.message);
                    showAlert('danger', data.data);
                    return;
                } else {
                    showAlert('success', 'Berhasil Diupdate');
                    // alert('Berhasil Diupdate');
                    setTimeout(function () {
                        window.open("/admin/customer_category", "_self");
                    }, 500);
                }
            },
            error: function (dataerror) {
                console.log(dataerror);
                showAlert('danger', ['Terjadi kesalahan pada server']);
            }
        });

    }

    function delete_data(id){
        var postdata = {};
        postdata._token = document.getElementsByName('_token')[0].defaultValue;
        
        if (confirm('Apakah Anda Yakin Menghapus Data Ini?')) {
            $.ajax({
                type: "DELETE",
                url: "/admin/customer_category/"+id,
                data: (postdata),
                dataType: "json",
                async: false,
                success: function (data) {
                    if (data.status == 401) {
                        showAlert('danger', data.data);
                        // alert('Form Wajib Harus diisi');
                        return;
                    } else if (data.status == 501) {
                        showAlert('danger', data.data);
                        // alert(data.message);
                        return;
                    } else {
                        showAlert('success', 'Berhasil Dihapus');
                        // alert('Data Berhasil Dihapus');
                        setTimeout(function () {
                            window.open("/admin/customer_category", "_self");
                        }, 500);
                    }
                },
                error: function (dataerror) {
                    console.log(dataerror);
                    showAlert('danger', ['Terjadi kesalahan pada server']);
                }
            });
        }
    }

</script>
@endsection
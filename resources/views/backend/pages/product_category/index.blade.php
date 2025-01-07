
@extends('backend.layouts.master')

@section('title')
Kategori - Admin Panel
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
                                <li class="breadcrumb-item active" aria-current="page"> Kategori Produk</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xxl-12 col-xl-12 col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5>Master Kategori Produk</h5>
                            <div class="d-flex align-items-center">
                                <div class="app-main-search me-2">
                                    <form action="/admin/product_category" method="GET" class="d-flex">
                                        <div class="input-box d-flex">
                                            <input type="text" name="search" id="search" value="{{$search ?? ''}}" class="form-control" placeholder="Search Here">
                                            <button type="submit" class="btn btn-light ms-2">
                                                <img src="{{ asset('backend/assets/images/svg/search.svg')}}" alt="Search" draggable="false">
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                @if ($usr->can('product_category.create'))
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
                                                            <th scope="col" width="5%">NO</th>
                                                            <th scope="col">CODE</th>
                                                            <th scope="col">NAME</th>
                                                            <th scope="col">NOTE</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tableBody">
                                                        @foreach ($product_category as $pcy)
                                                            <tr>
                                                                <td scope="row" class="text-center">{{ $loop->index+1 }}</td>
                                                                <td>{{ $pcy->product_category_code }}</td>
                                                                <td>{{ $pcy->product_category_name }}</td>
                                                                <td>{{ $pcy->product_category_notes }}</td>
                                                                <td class="text-center">
                                                                    <div class="d-flex justify-content-center gap-2">
                                                                        <!-- Tombol Delete -->
                                                                        @if ($usr->can('product_category.delete'))
                                                                        <button class="btn btn-light btn-sm border border-danger text-danger" title="Delete" onclick="delete_data('{{ $pcy->product_category_id }}')">
                                                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                <path d="M12.5 3.5L3.5 12.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                                <path d="M12.5 12.5L3.5 3.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                            </svg>
                                                                        </button>
                                                                        @endif
                                                                        <!-- Tombol Edit -->
                                                                        <button class="btn btn-light btn-sm border border-success text-success" title="Edit" onclick="showedit('{{ $pcy->product_category_id }}')">
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
                                            <ul class="pagination justify-content-end" id="pagination">
                                                <!-- Previous Page Link -->
                                                <li class="page-item {{ $product_category->onFirstPage() ? 'disabled' : '' }}">
                                                    <a class="page-link" href="{{ $product_category->appends(['search' => $search ?? request('search')])->previousPageUrl() }}" aria-label="Previous">
                                                        <i class="ph-arrow-left"></i>
                                                    </a>
                                                </li>

                                                <!-- Page Number Links -->
                                                @foreach ($product_category->onEachSide(0)->appends(['search' => $search ?? request('search')])->links()->elements[0] as $page => $url)
                                                    <li class="page-item {{ $product_category->currentPage() == $page ? 'active' : '' }}">
                                                        <a class="page-link" href="{{ $url }}">{{ sprintf('%02d', $page) }}</a>
                                                    </li>
                                                @endforeach

                                                <!-- Next Page Link -->
                                                <li class="page-item {{ $product_category->hasMorePages() ? '' : 'disabled' }}">
                                                    <a class="page-link" href="{{ $product_category->appends(['search' => $search ?? request('search')])->nextPageUrl() }}" aria-label="Next">
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
                    <input type="hidden" id="product_category_id">
                    <div id="alert-container"></div> <!-- Tempat Alert -->
                    <div class="fromGroup mb-3">
                        <label>Nama</label>
                        <input class="form-control" type="text" id="product_category_name" placeholder="Nama Kategori Produk" />
                    </div>
                    <div class="fromGroup mb-3">
                        <label>Note</label>
                        <textarea class="form-control" name="product_category_notes" id="product_category_notes" placeholder="Catatan"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                @if ($usr->can('product_category.create'))
                <button type="button" class="btn btn-warning" onclick="clearform()">Clear Data</button>
                @endif
                @if ($usr->can('product_category.update') || $usr->can('product_category.create'))
                <button type="button" class="btn btn-primary" id="saveclick" onclick="save()">Save</button>
                @endif
            </div>
        </div>
    </div>
</div>
<script>

    $(document).ready(function() {
        $('#search').on('keyup', function () {
            let searchQuery = $(this).val();
            fetchSubmenus(searchQuery, 1); // Panggil fungsi dengan searchQuery dan halaman pertama
        });

        $(document).on('click', '.page-link', function (e) {
            e.preventDefault(); // Mencegah reload halaman
            let page = $(this).data('page'); // Ambil nomor halaman dari data atribut
            let searchQuery = $('#search').val(); // Ambil nilai pencarian
            fetchSubmenus(searchQuery, page); // Panggil fungsi dengan searchQuery dan nomor halaman
        });

        function fetchSubmenus(searchQuery, page) {
            $.ajax({
                url: '/admin/product_category',
                type: 'GET',
                data: { 
                    search: searchQuery,
                    page: page
                },
                success: function (response) {
                    // Update table body
                    $('#tableBody').html('');
                    if (response.product_category.data.length > 0) {
                        response.product_category.data.forEach(function (product_category, index) {
                            $('#tableBody').append(`
                                <tr>
                                    <td class="text-center">${(response.product_category.current_page - 1) * response.product_category.per_page + index + 1}</td>
                                    <td>${ product_category.product_category_code }</td>
                                    <td>${ product_category.product_category_name }</td>
                                    <td>${ product_category.product_category_notes }</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <!-- Tombol Delete -->
                                            @if ($usr->can('product_category.delete'))
                                            <button class="btn btn-light btn-sm border border-danger text-danger" title="Delete" onclick="delete_data('${product_category.product_category_id}')">
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12.5 3.5L3.5 12.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M12.5 12.5L3.5 3.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </button>
                                            @endif
                                            <!-- Tombol Edit -->
                                            <button class="btn btn-light btn-sm border border-success text-success" title="Edit" onclick="showedit('${product_category.product_category_id}')">
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12.1464 1.85355C12.3417 1.65829 12.6583 1.65829 12.8536 1.85355L14.1464 3.14645C14.3417 3.34171 14.3417 3.65829 14.1464 3.85355L5.35355 12.6464L2.5 13.5L3.35355 10.6464L12.1464 1.85355Z" stroke="green" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M11.5 2.5L13.5 4.5" stroke="green" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            `);
                        });
                    } else {
                        $('#tableBody').append('<tr><td colspan="5" class="text-center">No results found</td></tr>');
                    }

                    // Update pagination
                    $('#pagination').html('');
                    response.product_category.links.forEach(function (link) {
                        let activeClass = link.active ? 'active' : '';
                        let url = link.url ? link.url + `&search=${searchQuery}` : ''; // Tambahkan parameter search ke URL
                        let pageLink = link.url ? `<a class="page-link ${activeClass}" href="#" data-page="${link.label}">${link.label}</a>` : '';
                        $('#pagination').append(`<li class="page-item ${activeClass}">${pageLink}</li>`);
                    });
                },
                error: function (xhr) {
                    alert('Error: ' + xhr.statusText);
                }
            });
        }
    });

    function reload(){
        // setTimeout(function () {
            window.open("/admin/product_category", "_self");
        // }, 500);
    }

    function save() {
        id = document.getElementById('product_category_id').value;
        if (id == '') {
            saveInput();
        } else {
            updateInput(id);
        }
    }

    function clearform() {
        document.getElementById('product_category_id').value = '';
        document.getElementById('product_category_name').value = '';
        document.getElementById('product_category_notes').value = '';

        document.getElementById('tittleform').innerHTML = 'Form Input';
        document.getElementById('saveclick').innerHTML = 'Save';
    }

    function saveInput() {
        var postdata = new FormData();
        // Tambahkan token CSRF
        postdata.append('_token', document.getElementsByName('_token')[0].defaultValue);
        postdata.append('product_category_name', document.getElementById('product_category_name').value); 
        postdata.append('product_category_notes', document.getElementById('product_category_notes').value); 

        $.ajax({
            type: "POST",
            url: "/admin/product_category",
            data: (postdata),
            processData: false, // Jangan ubah data
            contentType: false, // Atur tipe konten secara otomatis
            dataType: "json",
            async: false,
            success: function (data) {
                if (data.status == 401) {
                    showAlert('danger', "Form Wajib Diisi");
                    alertform('text',data.column,"Form ini Tidak Boleh Kosong");
                    return;
                } else if (data.status == 501) {
                    showAlert('danger', "Form Wajib Diisi");
                    alertform('text',data.column,"Form ini Tidak Boleh Kosong");
                    return;
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Data Saved!',
                    }).then(function() {
                        location.reload();
                    });
                }
            },
            error: function (dataerror) {
                console.log(dataerror);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: dataerror.responseJSON.message
                });
            }
        });

    }

    function showedit(id){
        $.ajax({
            type: "GET",
            url: "/admin/product_category/"+id,
            dataType: "json",
            async: false,
            success: function (data) {
                document.getElementById('product_category_id').value = data.product_category_id; 
                document.getElementById('product_category_name').value = data.product_category_name; 
                document.getElementById('product_category_notes').value = data.product_category_notes;
                
                document.getElementById('tittleform').innerHTML = 'Form Detail & Edit';
                document.getElementById('saveclick').innerHTML = 'Save Changes';
                // Tampilkan modal
                $('#modalinput').modal('show')
            },
            error: function (dataerror) {
                console.log(dataerror);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: dataerror.responseJSON.message
                });
            }
        });
    }

    function updateInput(id) {
        var postdata = new FormData();
        // Tambahkan token CSRF
        postdata.append('_token', document.getElementsByName('_token')[0].defaultValue);
        postdata.append('product_category_name', document.getElementById('product_category_name').value); 
        postdata.append('product_category_notes', document.getElementById('product_category_notes').value); 
        // console.log('Data FormData: ', Array.from(postdata.entries()));
        

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            type: "POST",
            url: "/admin/product_category/"+id,
            data: (postdata),
            processData: false, // Jangan ubah data
            contentType: false, // Atur tipe konten secara otomatis
            dataType: "json",
            async: false,
            success: function (data) {
                if (data.status == 401) {
                    showAlert('danger', "Form Wajib Diisi");
                    alertform('text',data.column,"Form ini Tidak Boleh Kosong");
                    return;
                } else if (data.status == 501) {
                    showAlert('danger', "Form Wajib Diisi");
                    alertform('text',data.column,"Form ini Tidak Boleh Kosong");
                    return;
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Data Updated!',
                    }).then(function() {
                        location.reload();
                    });
                }
            },
            error: function (dataerror) {
                console.log(dataerror);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: dataerror.responseJSON.message
                });
            }
        });

    }

    function delete_data(id){
        var postdata = {};
        postdata._token = document.getElementsByName('_token')[0].defaultValue;
        
        Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to revert this!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: "/admin/product_category/"+id,
                    data: (postdata),
                    dataType: "json",
                    async: false,
                    success: function (data) {
                        if (data.status == 401) {
                            showAlert('danger', data.data);
                            return;
                        } else if (data.status == 501) {
                            showAlert('danger', data.data);
                            return;
                        } else {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: 'Data has been deleted.',
                            }).then(function() {
                                location.reload();
                            });
                        }
                    },
                    error: function (dataerror) {
                        console.log(dataerror);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: dataerror.responseJSON.message
                        });
                    }
                });
            }
        });
    }

</script>
@endsection

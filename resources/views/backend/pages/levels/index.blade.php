
@extends('backend.layouts.master')

@section('title')
Level - Admin Panel
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
                        <div class="breadcrumb-title"> Account Setting</div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href='/admin'>Home</a></li>
                                <li class="breadcrumb-item"><a href='/admin'>Setting</a></li>
                                <li class="breadcrumb-item active" aria-current="page"> Level</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xxl-12 col-xl-12 col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5>Setting Level</h5>
                            <div class="d-flex align-items-center">
                                <div class="app-main-search me-2">
                                    <form action="/admin/levels" method="GET" class="d-flex">
                                        <div class="input-box d-flex">
                                            <input type="text" name="search" id="search" value="{{$search ?? ''}}" class="form-control" placeholder="Search Here">
                                            <button type="submit" class="btn btn-light ms-2">
                                                <img src="{{ asset('backend/assets/images/svg/search.svg')}}" alt="Search" draggable="false">
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                @if ($usr->can('levels.create'))
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
                                                        @foreach ($levels as $level)
                                                            <tr>
                                                                <td scope="row" class="text-center">{{ $loop->index+1 }}</td>
                                                                <td>{{ Str::words($level->level_code, 10, '...') }}</td>
                                                                <td>{{ Str::words($level->level_name, 10, '...') }}</td>
                                                                <td>{{ Str::words($level->level_notes, 10, '...') }}</td>
                                                                <td class="text-center">
                                                                    <div class="d-flex justify-content-center gap-2">
                                                                        <!-- Tombol Delete -->
                                                                        @if ($usr->can('levels.delete'))
                                                                        <button class="btn btn-light btn-sm border border-danger text-danger" title="Delete" onclick="delete_data('{{ $level->level_id }}')">
                                                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                <path d="M12.5 3.5L3.5 12.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                                <path d="M12.5 12.5L3.5 3.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                            </svg>
                                                                        </button>
                                                                        @endif
                                                                        <!-- Tombol Edit -->
                                                                        <button class="btn btn-light btn-sm border border-success text-success" title="Edit" onclick="showedit('{{ $level->level_id }}')">
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
                                                <li class="page-item {{ $levels->onFirstPage() ? 'disabled' : '' }}">
                                                    <a class="page-link" href="{{ $levels->appends(['search' => $search ?? request('search')])->previousPageUrl() }}" aria-label="Previous">
                                                        <i class="ph-arrow-left"></i>
                                                    </a>
                                                </li>

                                                <!-- Page Number Links -->
                                                @foreach ($levels->onEachSide(0)->appends(['search' => $search ?? request('search')])->links()->elements[0] as $page => $url)
                                                    <li class="page-item {{ $levels->currentPage() == $page ? 'active' : '' }}">
                                                        <a class="page-link" href="{{ $url }}">{{ sprintf('%02d', $page) }}</a>
                                                    </li>
                                                @endforeach

                                                <!-- Next Page Link -->
                                                <li class="page-item {{ $levels->hasMorePages() ? '' : 'disabled' }}">
                                                    <a class="page-link" href="{{ $levels->appends(['search' => $search ?? request('search')])->nextPageUrl() }}" aria-label="Next">
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
                    <input type="hidden" id="level_id">
                    <div id="alert-container"></div> <!-- Tempat Alert -->
                    <div class="fromGroup mb-3">
                        <label>Departemen</label>
                        <select class="form-control" id="department_code" style="width: 100%;">
                            <option value="" disabled selected>Pilih Departemen</option>
                        </select>
                    </div>
                    <div class="fromGroup mb-3">
                        <label>Nama</label>
                        <input class="form-control" type="text" id="level_name" placeholder="Nama Level" />
                    </div>
                    <div class="fromGroup mb-3">
                        <label>Note</label>
                        <textarea class="form-control" name="level_notes" id="level_notes" placeholder="Catatan"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                @if ($usr->can('levels.create'))
                <button type="button" class="btn btn-warning" onclick="clearform()">Clear Data</button>
                @endif
                @if ($usr->can('levels.update') || $usr->can('levels.create'))
                <button type="button" class="btn btn-primary" id="saveclick" onclick="save()">Save</button>
                @endif
            </div>
        </div>
    </div>
</div>
<script>

    $(document).ready(function() {        
        $('#modalinput').on('shown.bs.modal', function () {
            $('#department_code').select2({
                dropdownParent: $('#modalinput'),
                placeholder: "Pilih Departemen",
                allowClear: true,
                ajax: {
                    url: '/admin/combodepartments',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            search: params.term
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                }
            });
        });

        // Fokuskan input pencarian Select2
        $('#department_code').on('select2:open', function () {
            document.querySelector('.select2-search__field').focus();
        });

        $('#search').on('keyup', function () {
            let searchQuery = $(this).val();
            fetchSubmenus(searchQuery, 1); // Panggil fungsi dengan searchQuery dan halaman pertama
        });

        $(document).on('click', '.page-link', function (e) {
            e.preventDefault(); // Mencegah reload halaman
            let pageUrl = $(this).attr('href'); // Ambil URL dari elemen yang diklik
            let page = new URLSearchParams(pageUrl.split('?')[1]).get('page'); // Ambil nomor halaman dari URL
            let searchQuery = $('#search').val(); // Ambil nilai pencarian saat ini

            if (page) {
                fetchSubmenus(searchQuery, page); // Panggil fungsi dengan nomor halaman
            }
        });

    });

    function fetchSubmenus(searchQuery, page) {
        $.ajax({
            url: '/admin/levels',
            type: 'GET',
            data: { 
                search: searchQuery,
                page: page
            },
            success: function (response) {
                // Update table body
                $('#tableBody').html('');
                if (response.levels.data.length > 0) {
                    response.levels.data.forEach(function (levels, index) {
                        $('#tableBody').append(`
                            <tr>
                                <td class="text-center">${(response.levels.current_page - 1) * response.levels.per_page + index + 1}</td>
                                <td>${ truncateText(levels.level_code, 10, '...') }</td>
                                <td>${ truncateText(levels.level_name, 10, '...') }</td>
                                <td>${ truncateText(levels.level_notes, 10, '...') }</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <!-- Tombol Delete -->
                                        @if ($usr->can('levels.delete'))
                                        <button class="btn btn-light btn-sm border border-danger text-danger" title="Delete" onclick="delete_data('${levels.level_id}')">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12.5 3.5L3.5 12.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M12.5 12.5L3.5 3.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                        @endif
                                        <!-- Tombol Edit -->
                                        <button class="btn btn-light btn-sm border border-success text-success" title="Edit" onclick="showedit('${levels.level_id}')">
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

                paginemain(response,'levels');
            },
            error: function (xhr) {
                alert('Error: ' + xhr.statusText);
            }
        });
    }

    function reload(){
        // setTimeout(function () {
            window.open("/admin/levels", "_self");
        // }, 500);
    }

    function save() {
        id = document.getElementById('level_id').value;
        if (id == '') {
            saveInput();
        } else {
            updateInput(id);
        }
    }

    function clearform() {
        document.getElementById('level_id').value = '';
        $('#department_code').append(new Option('', '', true, true)).trigger('change');
        document.getElementById('level_name').value = '';
        document.getElementById('level_notes').value = '';

        document.getElementById('tittleform').innerHTML = 'Form Input';
        document.getElementById('saveclick').innerHTML = 'Save';
    }

    function saveInput() {
        var postdata = new FormData();
        // Tambahkan token CSRF
        postdata.append('_token', document.getElementsByName('_token')[0].defaultValue);
        postdata.append('department_code', document.getElementById('department_code').value); 
        postdata.append('level_name', document.getElementById('level_name').value); 
        postdata.append('level_notes', document.getElementById('level_notes').value); 

        $.ajax({
            type: "POST",
            url: "/admin/levels",
            data: (postdata),
            processData: false, // Jangan ubah data
            contentType: false, // Atur tipe konten secara otomatis
            dataType: "json",
            async: false,
            success: function (data) {
                if (data.status == 401) {
                    showAlert('danger', "Form Wajib Diisi");
                    if (data.column == 'department_code') {
                        alertform('select2',data.column,"Form ini Tidak Boleh Kosong");
                    } else {
                        alertform('text',data.column,"Form ini Tidak Boleh Kosong");
                    }
                    return;
                } else if (data.status == 501) {
                    showAlert('danger', "Form Wajib Diisi");
                    if (data.column == 'department_code') {
                        alertform('select2',data.column,"Form ini Tidak Boleh Kosong");
                    } else {
                        alertform('text',data.column,"Form ini Tidak Boleh Kosong");
                    }
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
            url: "/admin/levels/"+id,
            dataType: "json",
            async: false,
            success: function (data) {
                document.getElementById('level_id').value = data.level_id; 
                $('#department_code').append(new Option(data.department_name, data.department_code, true, true)).trigger('change');
                document.getElementById('level_name').value = data.level_name; 
                document.getElementById('level_notes').value = data.level_notes;
                
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
        postdata.append('department_code', document.getElementById('department_code').value); 
        postdata.append('level_name', document.getElementById('level_name').value); 
        postdata.append('level_notes', document.getElementById('level_notes').value); 
        // console.log('Data FormData: ', Array.from(postdata.entries()));
        

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            type: "POST",
            url: "/admin/levels/"+id,
            data: (postdata),
            processData: false, // Jangan ubah data
            contentType: false, // Atur tipe konten secara otomatis
            dataType: "json",
            async: false,
            success: function (data) {
                if (data.status == 401) {
                    showAlert('danger', "Form Wajib Diisi");
                    if (data.column == 'department_code') {
                        alertform('select2',data.column,"Form ini Tidak Boleh Kosong");
                    } else {
                        alertform('text',data.column,"Form ini Tidak Boleh Kosong");
                    }
                    return;
                } else if (data.status == 501) {
                    showAlert('danger', "Form Wajib Diisi");
                    if (data.column == 'department_code') {
                        alertform('select2',data.column,"Form ini Tidak Boleh Kosong");
                    } else {
                        alertform('text',data.column,"Form ini Tidak Boleh Kosong");
                    }
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
                    url: "/admin/levels/"+id,
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

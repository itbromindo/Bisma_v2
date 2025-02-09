@extends('backend.layouts.master')

@section('title')
Master Approvals - Admin Panel
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
                        <div class="breadcrumb-title">Master Approval Management</div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href='/admin'>Home</a></li>
                                <li class="breadcrumb-item"><a href='/admin/master_approvals'>Master</a></li>
                                <li class="breadcrumb-item"><a href='/admin/master_approvals'>Master Approval</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xxl-12 col-xl-12 col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5>Master Approvals</h5>
                            <div class="d-flex align-items-center">
                                <div class="app-main-search me-2">
                                    <form action="/admin/master_approvals" method="GET" class="d-flex">
                                        <div class="input-box d-flex">
                                            <input type="text" name="search" id="search" value="{{$search ?? ''}}"
                                                class="form-control" placeholder="Search Here">
                                            <button type="submit" class="btn btn-light ms-2">
                                                <img src="{{ asset('backend/assets/images/svg/search.svg')}}"
                                                    alt="Search" draggable="false">
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                @if ($usr->can('master_approvals.create'))
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#modalinput" onclick="clearForm()">Tambah Data</button>
                                @endif
                            </div>
                        </div>

                        <div class="card-body">
                            <section class="tables">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="table-wrapper">
                                            <div class="table-content table-responsive">
                                                <table class="table align-middle table-basic">
                                                    <thead style="text-align: center">
                                                        <tr>
                                                            <th scope="col" width="5%">NO</th>
                                                            <th scope="col">CODE</th>
                                                            <th scope="col">NAME</th>
                                                            <th scope="col">NOTES</th>
                                                            <th scope="col">DIVISION</th>
                                                            <th scope="col">DEPARTMENT</th>
                                                            <th scope="col">LEVEL</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tableBody">
                                                        @foreach ($masterApprovals as $approval)
                                                            <tr>
                                                                <td scope="row" class="text-center">
                                                                    {{ ($masterApprovals->currentPage() - 1) * $masterApprovals->perPage() + $loop->iteration }}
                                                                </td>
                                                                <td class="text-center">{{ Str::words($approval->master_approvals_code, 10, '...') }}</td>
                                                                 <td class="text-center">{{ Str::words($approval->master_approvals_approval_name, 10, '...') }}</td>
                                                                 <td class="text-center">{{ Str::words($approval->master_approvals_notes, 10, '...') }}</td>
                                                                 <td class="text-center">{{ Str::words($approval->division->division_name, 10, '...') ?? '-' }}</td>
                                                                 <td class="text-center">{{ Str::words($approval->department->department_name, 10, '...') ?? '-' }}</td>
                                                                 <td class="text-center">{{ Str::words($approval->level->level_name, 10, '...') ?? '-' }}</td>
                                                                <td class="text-center">
                                                                    <div class="d-flex justify-content-center gap-2">
                                                                        @if ($usr->can('master_approvals.delete'))
                                                                        <button
                                                                            class="btn btn-light btn-sm border border-danger text-danger"
                                                                            title="Delete"
                                                                            onclick="delete_data('{{ $approval->master_approvals_id }}')">
                                                                            <svg width="16" height="16" fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg">
                                                                                <path d="M12.5 3.5L3.5 12.5" stroke="red"
                                                                                    stroke-width="1.25"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round" />
                                                                                <path d="M12.5 12.5L3.5 3.5" stroke="red"
                                                                                    stroke-width="1.25"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round" />
                                                                            </svg>
                                                                        </button>
                                                                        @endif
                                                                        <button
                                                                            class="btn btn-light btn-sm border border-success text-success"
                                                                            title="Edit"
                                                                            onclick="showedit('{{ $approval->master_approvals_id }}')">
                                                                            <svg width="16" height="16" fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg">
                                                                                <path
                                                                                    d="M12.1464 1.85355C12.3417 1.65829 12.6583 1.65829 12.8536 1.85355L14.1464 3.14645C14.3417 3.34171 14.3417 3.65829 14.1464 3.85355L5.35355 12.6464L2.5 13.5L3.35355 10.6464L12.1464 1.85355Z"
                                                                                    stroke="green" stroke-width="1.25"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round" />
                                                                                <path d="M11.5 2.5L13.5 4.5" stroke="green"
                                                                                    stroke-width="1.25"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round" />
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

                                <div class="row">
                                    <div class="col-lg-12">
                                        <nav aria-label="Page navigation">
                                            <ul class="pagination justify-content-end">
                                                <!-- Previous Page Link -->
                                                <li
                                                    class="page-item {{ $masterApprovals->onFirstPage() ? 'disabled' : '' }}">
                                                    <a class="page-link"
                                                        href="{{ $masterApprovals->appends(['search' => $search ?? request('search')])->previousPageUrl() }}"
                                                        aria-label="Previous">
                                                        <i class="ph-arrow-left"></i>
                                                    </a>
                                                </li>

                                                <!-- Page Number Links -->
                                                @foreach ($masterApprovals->onEachSide(0)->appends(['search' => $search ?? request('search')])->links()->elements[0] as $page => $url)
                                                    <li
                                                        class="page-item {{ $masterApprovals->currentPage() == $page ? 'active' : '' }}">
                                                        <a class="page-link"
                                                            href="{{ $url }}">{{ sprintf('%02d', $page) }}</a>
                                                    </li>
                                                @endforeach

                                                <!-- Next Page Link -->
                                                <li
                                                    class="page-item {{ $masterApprovals->hasMorePages() ? '' : 'disabled' }}">
                                                    <a class="page-link"
                                                        href="{{ $masterApprovals->appends(['search' => $search ?? request('search')])->nextPageUrl() }}"
                                                        aria-label="Next">
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
<div class="modal fade" id="modalinput" role="dialog">
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
                    <input type="hidden" id="master_approvals_id">
                    <div id="alert-container"></div>
                    <div class="fromGroup mb-3">
                        <label>Master Approval Name</label>
                        <input class="form-control" type="text" id="master_approvals_approval_name"
                            placeholder="Master Approval Name" />
                    </div>
                    <div class="fromGroup mb-3">
                        <label>Notes</label>
                        <textarea class="form-control" name="master_approvals_notes" id="master_approvals_notes"
                            placeholder="Notes"></textarea>
                    </div>
                    <div class="fromGroup mb-3">
                        <label>Divsion</label>
                        {{-- <input class="form-control" type="text" id="moduls_code" placeholder="Code Modul" /> --}}
                        <select class="form-control" id="division_code" style="width: 100%;">
                            <option value="" disabled selected>Pilih Division</option>
                        </select>
                    </div>
                    <div class="fromGroup mb-3">
                        <label>Department</label>
                        {{-- <input class="form-control" type="text" id="moduls_code" placeholder="Code Modul" /> --}}
                        <select class="form-control" id="department_code" style="width: 100%;">
                            <option value="" disabled selected>Pilih Department</option>
                        </select>
                    </div>
                    <div class="fromGroup mb-3">
                        <label>Level</label>
                        {{-- <input class="form-control" type="text" id="moduls_code" placeholder="Code Modul" /> --}}
                        <select class="form-control" id="level_code" style="width: 100%;">
                            <option value="" disabled selected>Pilih Level</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        @if ($usr->can('master_approvals.create'))
                        @endif
                        <button type="button" class="btn btn-warning" onclick="clearForm()">Clear Data</button>
                        @if ($usr->can('master_approvals.update') || $usr->can('master_approvals.create'))
                        <button type="button" id="saveButton" class="btn btn-primary" onclick="save()">Save</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#modalinput').on('shown.bs.modal', function () {
            $('#division_code').select2({
                dropdownParent: $('#modalinput'),
                placeholder: "Select Division",
                allowClear: true,
                ajax: {
                    url: '/admin/combodivisions', 
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
                    }
                }
            });

            $('#department_code').select2({
                dropdownParent: $('#modalinput'),
                placeholder: "Select Department",
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
                    }
                }
            });

            $('#level_code').select2({
                dropdownParent: $('#modalinput'),
                placeholder: "Select Level",
                allowClear: true,
                ajax: {
                    url: '/admin/combolevels', 
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
                    }
                }
            });
        });

        $('#division_code').on('select2:open', function () {
            document.querySelector('.select2-search__field').focus();
        });

        $('#department_code').on('select2:open', function () {
            document.querySelector('.select2-search__field').focus();
        });

        $('#level_code').on('select2:open', function () {
            document.querySelector('.select2-search__field').focus();
        });
    });


    function clearForm() {  // tambahan clear data
        document.getElementById('master_approvals_id').value = '';
        document.getElementById('master_approvals_approval_name').value = '';
        document.getElementById('master_approvals_notes').value = '';
        $('#division_code').append(new Option('', '', true, true)).trigger('change');
        $('#department_code').append(new Option('', '', true, true)).trigger('change');
        $('#level_code').append(new Option('', '', true, true)).trigger('change');
        document.getElementById('level_code').value = '';
        document.getElementById('tittleform').innerHTML = 'Form Input';
        document.getElementById('saveButton').textContent = 'Save';
    }

    $(document).ready(function () {
        $('#search').on('keyup', function () {
            let searchQuery = $(this).val();
            $.ajax({
                url: '/admin/master_approvals',
                type: 'GET',
                data: { search: searchQuery },
                success: function (response) { 

                    $('#tableBody').html('');
                    if (response.masterApprovals.data.length > 0) {
                        response.masterApprovals.data.forEach(function (approval, index) {
                            $('#tableBody').append(`
                                <tr>
                                    <td class="text-center">${(response.masterApprovals.current_page - 1) * response.masterApprovals.per_page + index + 1}</td>
                                    <td class="text-center">${ truncateText(approval.master_approvals_code, 10, '...')}</td>
                                    <td class="text-center">${ truncateText(approval.master_approvals_approval_name, 10, '...')}</td>
                                    <td class="text-center">${ truncateText(approval.master_approvals_notes, 10, '...') ?? '-'}</td>
                                    <td class="text-center">${ truncateText(approval.division, 10, '...') ? approval.division.division_name : '-'}</td>
                                    <td class="text-center">${ truncateText(approval.department, 10, '...') ? approval.department.department_name : '-'}</td>
                                    <td class="text-center">${ truncateText(approval.level, 10, '...') ? approval.level.level_name : '-'}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            @if ($usr->can('master_approvals.delete'))
                                            <button class="btn btn-light btn-sm border border-danger text-danger" title="Delete" onclick="delete_data('${approval.master_approvals_id }')">
                                                <svg width="16" height="16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12.5 3.5L3.5 12.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M12.5 12.5L3.5 3.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </button>
                                            @endif
                                            <button class="btn btn-light btn-sm border border-success text-success" title="Edit" onclick="showedit('${approval.master_approvals_id }')">
                                                <svg width="16" height="16" fill="none" xmlns="http://www.w3.org/2000/svg">
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
                },
                error: function (xhr) {
                    alert('Error: ' + xhr.statusText);
                }
            });
        });
    });



    function reload() {
        window.open("/admin/master_approvals", "_self");
    }

    function save() {
        const id = document.getElementById('master_approvals_id').value;
        id ? updateInput(id) : saveInput();
    }

    function saveInput() {
        var postdata = new FormData();
        // Tambahkan token CSRF
        postdata.append('_token', document.getElementsByName('_token')[0].defaultValue);
        postdata.append('master_approvals_approval_name', document.getElementById('master_approvals_approval_name').value); 
        postdata.append('master_approvals_notes', document.getElementById('master_approvals_notes').value); 
        postdata.append('division_code', document.getElementById('division_code').value); 
        postdata.append('department_code', document.getElementById('department_code').value); 
        postdata.append('level_code', document.getElementById('level_code').value); 

        $.ajax({
            type: "POST",
            url: "/admin/master_approvals",
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

   
    function updateInput(id) {
        var postdata = new FormData();
        // Tambahkan token CSRF
        postdata.append('_token', document.getElementsByName('_token')[0].defaultValue);
        postdata.append('master_approvals_approval_name', document.getElementById('master_approvals_approval_name').value); 
        postdata.append('master_approvals_notes', document.getElementById('master_approvals_notes').value); 
        postdata.append('division_code', document.getElementById('division_code').value); 
        postdata.append('department_code', document.getElementById('department_code').value); 
        postdata.append('level_code', document.getElementById('level_code').value); 
        // console.log('Data FormData: ', Array.from(postdata.entries()));
        

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            type: "POST",
            url: "/admin/master_approvals/"+id,
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
    function delete_data(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/admin/master_approvals/${id}`,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        if (response.status === 200) {
                            Swal.fire(
                                'Deleted!',
                                response.message,
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire(
                                'Failed!',
                                response.message || 'Something went wrong.',
                                'error'
                            );
                        }
                    },
                    error: function (xhr) {
                        Swal.fire(
                            'Error!',
                            xhr.responseJSON?.message || 'Failed to delete data.',
                            'error'
                        );
                    }
                });

            }
        });
    }

    function showedit(id) {
        $.get(`/admin/master_approvals/${id}`, function (data) {
            document.getElementById('master_approvals_id').value = data.master_approvals_id;
            document.getElementById('master_approvals_approval_name').value = data.master_approvals_approval_name;
            document.getElementById('master_approvals_notes').value = data.master_approvals_notes;
            $('#division_code').append(new Option(data.division_name, data.division_code, true, true)).trigger('change');
            $('#department_code').append(new Option(data.department_name, data.department_code, true, true)).trigger('change');
            $('#level_code').append(new Option(data.level_name, data.level_code, true, true)).trigger('change');
            document.getElementById('tittleform').innerHTML = 'Form Detail & Edit';
            document.getElementById('saveButton').textContent = 'Save Changes';
            $('#modalinput').modal('show');
        });
    }
</script>
@endsection
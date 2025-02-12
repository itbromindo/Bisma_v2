@extends('backend.layouts.master')

@section('title')
Divisions - Admin Panel
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
                        <div class="breadcrumb-title">Division Management</div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href='/admin'>Home</a></li>
                                <li class="breadcrumb-item"><a href='/admin/divisions'>Master</a></li>
                                <li class="breadcrumb-item"><a href='/admin/divisions'>Division</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xxl-12 col-xl-12 col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5>Master Divisions</h5>
                            <div class="d-flex align-items-center">
                                <div class="app-main-search me-2">
                                    <form action="/admin/divisions" method="GET" class="d-flex">
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
                                @if ($usr->can('divisions.create'))
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalinput" onclick="clearForm()">Tambah Data</button>
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
                                                            <th scope="col">COMPANY</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tableBody">
                                                        @foreach ($divisions as $division)
                                                            <tr>
                                                                <td scope="row" class="text-center">
                                                                    {{ ($divisions->currentPage() - 1) * $divisions->perPage() + $loop->iteration }}
                                                                </td>
                                                                <td class="text-center">{{ Str::words($division->division_code, 10, '...') }}</td>
                                                                <td class="text-center">{{ Str::words($division->division_name, 10, '...') }}</td>
                                                                <td class="text-left">{{ Str::words($division->division_notes, 10, '...') }}</td>
                                                                <td class="text-center">
                                                                    {{ $division->company->companies_name ?? '-' }}</td>
                                                                <td class="text-center">
                                                                    <div class="d-flex justify-content-center gap-2">
                                                                        @if ($usr->can('divisions.delete'))
                                                                        <button
                                                                            class="btn btn-light btn-sm border border-danger text-danger"
                                                                            title="Delete"
                                                                            onclick="delete_data('{{ $division->division_id }}')">
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
                                                                            onclick="showedit('{{ $division->division_id }}')">
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
                                                <li class="page-item {{ $divisions->onFirstPage() ? 'disabled' : '' }}">
                                                    <a class="page-link"
                                                        href="{{ $divisions->appends(['search' => $search ?? request('search')])->previousPageUrl() }}"
                                                        aria-label="Previous">
                                                        <i class="ph-arrow-left"></i>
                                                    </a>
                                                </li>

                                                <!-- Page Number Links -->
                                                @foreach ($divisions->onEachSide(0)->appends(['search' => $search ?? request('search')])->links()->elements[0] as $page => $url)
                                                    <li
                                                        class="page-item {{ $divisions->currentPage() == $page ? 'active' : '' }}">
                                                        <a class="page-link"
                                                            href="{{ $url }}">{{ sprintf('%02d', $page) }}</a>
                                                    </li>
                                                @endforeach

                                                <!-- Next Page Link -->
                                                <li
                                                    class="page-item {{ $divisions->hasMorePages() ? '' : 'disabled' }}">
                                                    <a class="page-link"
                                                        href="{{ $divisions->appends(['search' => $search ?? request('search')])->nextPageUrl() }}"
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
<div class="modal fade" id="modalinput" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                    <input type="hidden" id="division_id">
                    <div id="alert-container"></div> 
                    <div class="fromGroup mb-3">
                        <label>Company</label>
                        <select class="form-control" id="companies_code" style="width: 100%;">
                            <option value="" disabled selected>Pilih Company</option>
                        </select>
                    </div>
                    <div class="fromGroup mb-3">
                        <label>Division Name</label>
                        <input class="form-control" type="text" id="division_name" placeholder="Division Name" />
                    </div>
                    <div class="fromGroup mb-3">
                        <label>Notes</label>
                        <textarea class="form-control" name="division_notes" id="division_notes"
                            placeholder="Notes"></textarea>
                    </div>
                    

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        @if ($usr->can('divisions.create'))
                        <button type="button" class="btn btn-warning" onclick="clearForm()">Clear Data</button>
                        @endif
                        @if ($usr->can('divisions.update') || $usr->can('divisions.create'))
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
            $('#companies_code').select2({
                dropdownParent: $('#modalinput'),
                placeholder: "Pilih Company",
                allowClear: true,
                ajax: {
                    url: '/admin/combocompanies',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            search: params.term // Parameter pencarian
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

        // Fokuskan input pencarian Select2
        $('#companies_code').on('select2:open', function () {
            document.querySelector('.select2-search__field').focus();
        });
    });

    function clearForm() {  // tambahan clear data
        document.getElementById('division_id').value = '';
        document.getElementById('division_name').value = '';
        document.getElementById('division_notes').value = '';
        $('#companies_code').append(new Option('', '', true, true)).trigger('change');

        document.getElementById('tittleform').innerHTML = 'Form Input';
        document.getElementById('saveButton').textContent = 'Save';
    }

    $(document).ready(function () {
        $('#search').on('keyup', function () {
            let searchQuery = $(this).val();
            $.ajax({
                url: '/admin/divisions',
                type: 'GET',
                data: { search: searchQuery },
                success: function (response) {

                    $('#tableBody').html('');
                    if (response.divisions.data.length > 0) {
                        response.divisions.data.forEach(function (division, index) {
                            $('#tableBody').append(`
                                <tr>
                                    <td class="text-center">${(response.divisions.current_page - 1) * response.divisions.per_page + index + 1}</td>
                                    <td class="text-center">${ truncateText(division.division_code, 10, '...')}</td>
                                    <td class="text-center">${ truncateText(division.division_name, 10, '...')}</td>
                                    <td class="text-center">${ truncateText(division.division_notes, 10, '...')?? ''}</td>
                                    <td class="text-center">${division.company ? division.company.companies_name : '-'}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            @if ($usr->can('divisions.delete'))
                                            <button class="btn btn-light btn-sm border border-danger text-danger" title="Delete" onclick="delete_data('${division.division_id}')">
                                                <svg width="16" height="16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12.5 3.5L3.5 12.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M12.5 12.5L3.5 3.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </button>
                                            @endif
                                            <button class="btn btn-light btn-sm border border-success text-success" title="Edit" onclick="showedit('${division.division_id}')">
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
        window.open("/admin/divisions", "_self");
    }

    function save() {
        const id = document.getElementById('division_id').value;
        id ? updateInput(id) : saveInput();
    }

    function saveInput() {
        var postdata = new FormData();
        // Tambahkan token CSRF
        postdata.append('_token', document.getElementsByName('_token')[0].defaultValue);
        postdata.append('division_name', document.getElementById('division_name').value); 
        postdata.append('division_notes', document.getElementById('division_notes').value); 
        postdata.append('companies_code', document.getElementById('companies_code').value); 

        $.ajax({
            type: "POST",
            url: "/admin/divisions",
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
        postdata.append('division_name', document.getElementById('division_name').value); 
        postdata.append('division_notes', document.getElementById('division_notes').value); 
        postdata.append('companies_code', document.getElementById('companies_code').value); 
        // console.log('Data FormData: ', Array.from(postdata.entries()));
        

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            type: "POST",
            url: "/admin/divisions/"+id,
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
            text: 'You will not be able to revert this!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/admin/divisions/${id}`,
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function (response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: 'Data has been deleted.',
                        }).then(function () {
                            location.reload();
                        });
                    }
                });
            }
        });
    }

    function showedit(id) {
        $.get(`/admin/divisions/${id}`, function (data) {
            // console.log(data);
            document.getElementById('division_id').value = data.division_id;
            document.getElementById('division_name').value = data.division_name;
            document.getElementById('division_notes').value = data.division_notes;
            $('#companies_code').append(new Option(data.companies_name, data.companies_code, true, true)).trigger('change');
            document.getElementById('tittleform').innerHTML = 'Form Detail & Edit';
            document.getElementById('saveButton').textContent = 'Save Changes';
            $('#modalinput').modal('show');
        });
    }

    
</script> 

@endsection
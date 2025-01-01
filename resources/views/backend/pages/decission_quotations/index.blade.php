@extends('backend.layouts.master')

@section('title')
Decission Quotation - Admin Panel
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
                        <div class="breadcrumb-title">Master Decission Quotation</div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href='/admin'>Home</a></li>
                                <li class="breadcrumb-item"><a href='/admin/decission_quotations'>Origin</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><a href='/admin/decission_quotations'>Decission Quotation</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xxl-12 col-xl-12 col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5>Decission Quotation Management</h5>
                            <div class="d-flex align-items-center">
                                <div class="app-main-search me-2">
                                    <form action="/admin/decission_quotations" method="GET" class="d-flex">
                                        <div class="input-box d-flex">
                                            <input type="text" name="search" id="search" value="{{$search ?? ''}}" class="form-control" placeholder="Search Here">
                                            <button type="submit" class="btn btn-light ms-2">
                                                <img src="{{ asset('backend/assets/images/svg/search.svg') }}" alt="Search" draggable="false">
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalinput">Tambah Data</button>
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
                                                    <th scope="col">NO</th>
                                                    <th scope="col">CODE</th>
                                                    <th scope="col">TITLE</th>   
                                                    <th scope="col">TEXT</th>
                                                    <th scope="col">NOTE</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tableBody" >
                                                @foreach ($decission_quotations as $quotation)
                                                    <tr>
                                                    <td scope="row" class="text-center">
                                                                    {{ ($decission_quotations->currentPage() - 1) * $decission_quotations->perPage() + $loop->iteration }}
                                                                </td>
                                                                <td class="text-center">{{ $quotation->template_decission_quotation_code }}</td>
                                                         <td class="text-center">{{ $quotation->template_decission_quotation_title }}</td>
                                                         <td class="text-center">{{ $quotation->template_decission_quotation_text }}</td>
                                                         <td class="text-center">{{ $quotation->template_decission_quotation_notes }}</td>
                                                        <!-- <td>{{ $quotation->is_deleted ? 'Deleted' : 'Active' }}</td> -->
                                                        
                                                                <td class="text-center">
                                                                    <div class="d-flex justify-content-center gap-2">
                                                                        <button class="btn btn-light btn-sm border border-danger text-danger" title="Delete" onclick="delete_data('{{ $quotation->template_decission_quotation_id }}')">
                                                                            <svg width="16" height="16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                <path d="M12.5 3.5L3.5 12.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                                <path d="M12.5 12.5L3.5 3.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                            </svg>
                                                                        </button>
                                                                        <button class="btn btn-light btn-sm border border-success text-success" title="Edit" onclick="showedit('{{ $quotation->template_decission_quotation_id }}')">
                                                                            <svg width="16" height="16" fill="none" xmlns="http://www.w3.org/2000/svg">
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

                                <div class="row">
                                    <div class="col-lg-12">
                                        <nav aria-label="Page navigation">
                                            <ul class="pagination justify-content-end">
                                                <li class="page-item {{ $decission_quotations->onFirstPage() ? 'disabled' : '' }}">
                                                    <a class="page-link" href="{{ $decission_quotations->previousPageUrl() }}" aria-label="Previous">
                                                        <i class="ph-arrow-left"></i>
                                                    </a>
                                                </li>

                                                @foreach ($decission_quotations->links()->elements[0] as $page => $url)
                                                    <li class="page-item {{ $decission_quotations->currentPage() == $page ? 'active' : '' }}">
                                                        <a class="page-link" href="{{ $url }}">{{ sprintf('%02d', $page) }}</a>
                                                    </li>
                                                @endforeach

                                                <li class="page-item {{ $decission_quotations->hasMorePages() ? '' : 'disabled' }}">
                                                    <a class="page-link" href="{{ $decission_quotations->nextPageUrl() }}" aria-label="Next">
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
                <h5 class="modal-title">Form Input</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" id="template_decission_quotation_id">
                    <div class="fromGroup mb-3">
                        <label>Title</label>
                        <input class="form-control" type="text" id="template_decission_quotation_title" placeholder="Title">
                    </div>
                    <div class="fromGroup mb-3">
                        <label>Text</label>
                        <textarea class="form-control" id="template_decission_quotation_text" placeholder="Text"></textarea>
                    </div>
                    <div class="fromGroup mb-3">
                        <label>Notes</label>
                        <textarea class="form-control" id="template_decission_quotation_notes" placeholder="Notes"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-warning" onclick="clearform()">Clear Data</button>
                @if ($usr->can('decission_quotation.update') || $usr->can('decission_quotation.create'))
                <button type="button" id="saveButton" class="btn btn-primary" onclick="save()">Save</button>
                @endif
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

$(document).ready(function () {
    $('#search').on('keyup', function () {
        let searchQuery = $(this).val();
        $.ajax({
            url: '/admin/decission_quotations',
            type: 'GET',
            data: { search: searchQuery },
            success: function (response) {
                let tableBody = $('#tableBody');
                tableBody.html('');  // Hapus isi tabel sebelumnya

                if (response.decission_quotations.data.length > 0) {
                    response.decission_quotations.data.forEach(function (quotation, index) {
                        tableBody.append(`
                            <tr>
                                <td class="text-center">${(response.decission_quotations.current_page - 1) * response.decission_quotations.per_page + index + 1}</td>
                                <td class="text-center">${quotation.template_decission_quotation_code}</td>
                                <td class="text-center">${quotation.template_decission_quotation_title}</td>
                                
                                <td class="text-center">${quotation.template_decission_quotation_text ?? '-'}</td>
                                <td class="text-center">${quotation.template_decission_quotation_notes}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <button class="btn btn-light btn-sm border border-danger text-danger" title="Delete" onclick="delete_data('${quotation.template_decission_quotation_id}')">
                                            <svg width="16" height="16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12.5 3.5L3.5 12.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M12.5 12.5L3.5 3.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                        <button class="btn btn-light btn-sm border border-success text-success" title="Edit" onclick="showedit('${quotation.template_decission_quotation_id}')">
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
                    tableBody.append('<tr><td colspan="5" class="text-center">No results found</td></tr>');
                }
            },
            error: function (xhr) {
                alert('Error: ' + xhr.statusText);
            }
        });
    });
});


    function reload() {
        window.open("/admin/decission_quotations", "_self");
    }

    function clearform() {
        document.getElementById('template_decission_quotation_id').value = '';
        document.getElementById('template_decission_quotation_title').value = '';
        document.getElementById('template_decission_quotation_text').value = '';
        document.getElementById('template_decission_quotation_notes').value = '';
        document.getElementById('saveButton').textContent = 'Save';

        document.getElementById('tittleform').innerHTML = 'Form Input';
    }

    function save() {
        const id = document.getElementById('template_decission_quotation_id').value;
        id ? updateInput(id) : saveInput();
    }

    function saveInput() {
        const data = {
            template_decission_quotation_title: document.getElementById('template_decission_quotation_title').value,
            template_decission_quotation_text: document.getElementById('template_decission_quotation_text').value,
            template_decission_quotation_notes: document.getElementById('template_decission_quotation_notes').value,
            _token: '{{ csrf_token() }}'
        };

        $.post('/admin/decission_quotations', data, function(response) {
            if (response.status === 401) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.data
                });
            } else {
                Swal.fire({
                    icon: 'success',
                    title: 'Saved',
                    text: 'Data has been saved successfully!'
                }).then(() => {
                    location.reload();
                });
            }
        });
    }

    function updateInput(id) {
        const data = {
            template_decission_quotation_title: document.getElementById('template_decission_quotation_title').value,
            template_decission_quotation_text: document.getElementById('template_decission_quotation_text').value,
            template_decission_quotation_notes: document.getElementById('template_decission_quotation_notes').value,
            _token: '{{ csrf_token() }}'
        };

        $.ajax({
            url: `/admin/decission_quotations/${id}`,
            type: 'PUT',
            data: data,
            success: function(response) {
                if (response.status === 401) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.data
                    });
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Updated',
                        text: 'Data has been updated successfully!'
                    }).then(() => {
                        location.reload();
                    });
                }
            }
        });
    }

    function delete_data(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/admin/decission_quotations/${id}`,
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted',
                            text: 'Data has been deleted successfully!'
                        }).then(() => {
                            location.reload();
                        });
                    }
                });
            }
        });
    }

    function showedit(id) {
        $.get(`/admin/decission_quotations/${id}`, function(data) {
            document.getElementById('template_decission_quotation_id').value = data.template_decission_quotation_id;
            document.getElementById('template_decission_quotation_title').value = data.template_decission_quotation_title;
            document.getElementById('template_decission_quotation_text').value = data.template_decission_quotation_text;
            document.getElementById('template_decission_quotation_notes').value = data.template_decission_quotation_notes;
            document.getElementById('saveButton').textContent = 'Save Changes';
            $('#modalinput').modal('show');
        });
    }
</script>

@endsection

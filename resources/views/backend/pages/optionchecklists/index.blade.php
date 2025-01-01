@extends('backend.layouts.master')

@section('title')
Option Checklists - Admin Panel
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
                        <div class="breadcrumb-title">Option Checklist Management</div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href='/admin'>Home</a></li>
                                <li class="breadcrumb-item"><a href='/admin/optionchecklists'>Pillars</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><a href='/admin/optionchecklists'>Option Checklists</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xxl-12 col-xl-12 col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5>Master Option Checklists</h5>
                            <div class="d-flex align-items-center">
                                <div class="app-main-search me-2">
                                    <form action="/admin/optionchecklists" method="GET" class="d-flex">
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
                                                    <th scope="col">ITEM</th>
                                                    <th scope="col">NOTE</th>
                                                    <th scope="col">CHECKLIST</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tableBody">
                                                @foreach ($option_checklist as $checklist)
                                                    <tr>
                                                    <td scope="row" class="text-center">
                                                                    {{ ($option_checklist->currentPage() - 1) * $option_checklist->perPage() + $loop->iteration }}
                                                                </td>
                                                                <td class="text-center">{{ $checklist->option_checklist_code }}</td>
                                                         <td class="text-center">{{ $checklist->option_checklist_items }}</td>
                                                         <td class="text-center">{{ $checklist->option_checklist_notes }}</td>
                                                         <td class="text-center">{{ $checklist->checklist->checklist_items }}</td>
                                                                <td class="text-center">
                                                                    <div class="d-flex justify-content-center gap-2">
                                                                        <button class="btn btn-light btn-sm border border-danger text-danger" title="Delete" onclick="delete_data('{{ $checklist->option_checklist_id }}')">
                                                                            <svg width="16" height="16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                <path d="M12.5 3.5L3.5 12.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                                <path d="M12.5 12.5L3.5 3.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                            </svg>
                                                                        </button>
                                                                        <button class="btn btn-light btn-sm border border-success text-success" title="Edit" onclick="showedit('{{ $checklist->option_checklist_id }}')">
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
                                                <!-- Pagination controls -->
                                                <li class="page-item {{ $option_checklist->onFirstPage() ? 'disabled' : '' }}">
                                                    <a class="page-link" href="{{ $option_checklist->appends(['search' => $search ?? request('search')])->previousPageUrl() }}" aria-label="Previous">
                                                        <i class="ph-arrow-left"></i>
                                                    </a>
                                                </li>
                                                @foreach ($option_checklist->onEachSide(0)->appends(['search' => $search ?? request('search')])->links()->elements[0] as $page => $url)
                                                    <li class="page-item {{ $option_checklist->currentPage() == $page ? 'active' : '' }}">
                                                        <a class="page-link" href="{{ $url }}">{{ sprintf('%02d', $page) }}</a>
                                                    </li>
                                                @endforeach
                                                <li class="page-item {{ $option_checklist->hasMorePages() ? '' : 'disabled' }}">
                                                    <a class="page-link" href="{{ $option_checklist->appends(['search' => $search ?? request('search')])->nextPageUrl() }}" aria-label="Next">
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
                    <input type="hidden" id="option_checklist_id">
                    <div class="fromGroup mb-3">
                        <label>Option Checklist Items</label>
                        <input class="form-control" type="text" id="option_checklist_items" placeholder="Option Checklist Items" />
                    </div>
                    <div class="fromGroup mb-3">
                        <label>Notes</label>
                        <textarea class="form-control" name="option_checklist_notes" id="option_checklist_notes" placeholder="Notes"></textarea>
                    </div>
                    <select class="form-control mb-3" id="checklist_code">
                        <option value="">Select Checklist</option>
                        @if($checklists)
                            @foreach ($checklists as $checklist)
                                <option value="{{ $checklist->checklist_code }}">{{ $checklist->checklist_items }}</option>
                            @endforeach
                        @else
                                    <option value="" disabled>No Checklist Available</option>
                        @endif
                    </select>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-warning" onclick="clearform()">Clear Data</button>
                @if ($usr->can('optionchecklists.update') || $usr->can('optionchecklists.create'))
                        <button type="button" id="saveButton" class="btn btn-primary" onclick="save()">Save</button>
                        @endif
                    </div>
                </form>
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
                url: '/admin/optionchecklists',
                type: 'GET',
                data: { search: searchQuery },
                success: function (response) {

                    $('#tableBody').html('');
                    if (response.option_checklist.data.length > 0) {
                        response.option_checklist.data.forEach(function (checklist, index) {
                            $('#tableBody').append(`
                                <tr>
                                    <td class="text-center">${(response.option_checklist.current_page - 1) * response.option_checklist.per_page + index + 1}</td>
                                    <td class="text-center">${checklist.option_checklist_code}</td>
                                    <td class="text-center">${checklist.option_checklist_items}</td>
                                    <td class="text-center">${checklist.option_checklist_notes ?? '-'}</td>
                                    
                                    <td class="text-center">${checklist.checklist ? checklist.checklist.checklist_items : '-'}</td>
                                    <td class="text-center">
                                                                    <div class="d-flex justify-content-center gap-2">
                                                                        <button class="btn btn-light btn-sm border border-danger text-danger" title="Delete" onclick="delete_data('${checklist.option_checklist_id}')">
                                                                            <svg width="16" height="16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                <path d="M12.5 3.5L3.5 12.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                                <path d="M12.5 12.5L3.5 3.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                            </svg>
                                                                        </button>
                                                                        <button class="btn btn-light btn-sm border border-success text-success" title="Edit" onclick="showedit('${checklist.option_checklist_id}')">
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
        window.open("/admin/optionchecklists", "_self");
    }

    function clearform() {
        document.getElementById('option_checklist_id').value = '';
        document.getElementById('option_checklist_items').value = '';
        document.getElementById('option_checklist_notes').value = '';
        document.getElementById('checklist_code').value = '';
        document.getElementById('saveButton').textContent = 'Save';

        document.getElementById('tittleform').innerHTML = 'Form Input';
    }

    function save() {
        const id = document.getElementById('option_checklist_id').value;
        id ? updateInput(id) : saveInput();
    }

    function saveInput() {
        const data = {
            option_checklist_items: document.getElementById('option_checklist_items').value,
            option_checklist_notes: document.getElementById('option_checklist_notes').value,
            checklist_code: document.getElementById('checklist_code').value,
            _token: '{{ csrf_token() }}'
        };

        $.post('/admin/optionchecklists', data)
            .done(function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Saved!',
                    text: 'Data has been saved successfully.'
                }).then(() => {
                    location.reload();
                });
            })
            .fail(function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: xhr.responseJSON?.message || 'Failed to save data.'
                });
            });
    }

    function updateInput(id) {
        const data = {
            option_checklist_items: document.getElementById('option_checklist_items').value,
            option_checklist_notes: document.getElementById('option_checklist_notes').value,
            checklist_code: document.getElementById('checklist_code').value,
            _token: '{{ csrf_token() }}'
        };

        $.ajax({
            url: `/admin/optionchecklists/${id}`,
            type: 'PUT',
            data: data
        })
            .done(function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Updated!',
                    text: 'Data has been updated successfully.'
                }).then(() => {
                    location.reload();
                });
            })
            .fail(function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: xhr.responseJSON?.message || 'Failed to update data.'
                });
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
                    url: `/admin/optionchecklists/${id}`,
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' }
                })
                    .done(function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: 'Data has been deleted successfully.'
                        }).then(() => {
                            location.reload();
                        });
                    })
                    .fail(function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: xhr.responseJSON?.message || 'Failed to delete data.'
                        });
                    });
            }
        });
    }

    function showedit(id) {
        $.get(`/admin/optionchecklists/${id}`)
            .done(function(data) {
                document.getElementById('option_checklist_id').value = data.option_checklist_id;
                document.getElementById('option_checklist_items').value = data.option_checklist_items;
                document.getElementById('option_checklist_notes').value = data.option_checklist_notes;
                document.getElementById('checklist_code').value = data.checklist_code;
                document.getElementById('saveButton').textContent = 'Save Changes';
                // Tampilkan modal tanpa notifikasi
                $('#modalinput').modal('show');
            })
            .fail(function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: xhr.responseJSON?.message || 'Failed to fetch data.'
                });
            });
    }
</script>


@endsection

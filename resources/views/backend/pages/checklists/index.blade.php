@extends('backend.layouts.master')

@section('title')
Checklists - Admin Panel
@endsection

@section('admin-content')
<div class="content-wrapper">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 rt-mb-25">
                    <div class="breadcrumbs">
                        <div class="breadcrumb-title">Checklist Management</div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href='/admin'>Home</a></li>
                                <li class="breadcrumb-item"><a href='/admin'>Management</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Checklists</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xxl-12 col-xl-12 col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5>Master Checklists</h5>
                            <div class="d-flex align-items-center">
                                <div class="app-main-search me-2">
                                    <form action="/admin/checklists" method="GET" class="d-flex">
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
                                                            <th scope="col" width="5%">NO</th>
                                                            <th scope="col">CHECKLIST ITEMS</th>
                                                            <th scope="col">NOTES</th>
                                                            <th scope="col">CODE</th>
                                                            <th scope="col">PILLAR CODE</th>
                                                            <th scope="col">ACTION</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tableBody">
                                                        @foreach ($checklists as $checklist)
                                                            <tr>
                                                                <td scope="row" class="text-center">
                                                                    {{ ($checklists->currentPage() - 1) * $checklists->perPage() + $loop->iteration }}
                                                                </td>
                                                                <td>{{ $checklist->checklist_items }}</td>
                                                                <td>{{ $checklist->checklist_notes }}</td>
                                                                <td>{{ $checklist->checklist_code }}</td>
                                                                <td>{{ $checklist->pillar_code }}</td>
                                                                <td class="text-center">
                                                                    <div class="d-flex justify-content-center gap-2">
                                                                        <button class="btn btn-light btn-sm border border-danger text-danger" title="Delete" onclick="delete_data('{{ $checklist->checklist_id }}')">
                                                                            <svg width="16" height="16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                <path d="M12.5 3.5L3.5 12.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                                <path d="M12.5 12.5L3.5 3.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                            </svg>
                                                                        </button>
                                                                        <button class="btn btn-light btn-sm border border-success text-success" title="Edit" onclick="showedit('{{ $checklist->checklist_id }}')">
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
                                                <!-- Previous Page Link -->
                                                <li class="page-item {{ $checklists->onFirstPage() ? 'disabled' : '' }}">
                                                    <a class="page-link" href="{{ $checklists->appends(['search' => $search ?? request('search')])->previousPageUrl() }}" aria-label="Previous">
                                                        <i class="ph-arrow-left"></i>
                                                    </a>
                                                </li>

                                                <!-- Page Number Links -->
                                                @foreach ($checklists->onEachSide(0)->appends(['search' => $search ?? request('search')])->links()->elements[0] as $page => $url)
                                                    <li class="page-item {{ $checklists->currentPage() == $page ? 'active' : '' }}">
                                                        <a class="page-link" href="{{ $url }}">{{ sprintf('%02d', $page) }}</a>
                                                    </li>
                                                @endforeach

                                                <!-- Next Page Link -->
                                                <li class="page-item {{ $checklists->hasMorePages() ? '' : 'disabled' }}">
                                                    <a class="page-link" href="{{ $checklists->appends(['search' => $search ?? request('search')])->nextPageUrl() }}" aria-label="Next">
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
                    <input type="hidden" id="checklist_id">
                    <div class="fromGroup mb-3">
                        <label>Checklist Items</label>
                        <input class="form-control" type="text" id="checklist_items" placeholder="Checklist Items" />
                    </div>
                    <div class="fromGroup mb-3">
                        <label>Notes</label>
                        <textarea class="form-control" name="checklist_notes" id="checklist_notes" placeholder="Notes"></textarea>
                    </div>
                    <select class="form-control mb-3" id="pillar_code">
                        <option value="">Select Pillar</option>
                            @if($pillars)
                                @foreach ($pillars as $pillar)
                                    <option value="{{ $pillar->pillar_code }}">{{ $pillar->pillar_items }}</option>
                                @endforeach
                            @else
                                    <option value="" disabled>No Pillar Available</option>
                            @endif
                    </select>
                    <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-warning" onclick="reload()">New Data</button>
                <button type="button" class="btn btn-primary" onclick="save()">Save changes</button>
            </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function reload() {
        window.open("/admin/checklists", "_self");
    }

    function save() {
        const id = document.getElementById('checklist_id').value;
        id ? updateInput(id) : saveInput();
    }

    function saveInput() {
        const data = {
            checklist_items: document.getElementById('checklist_items').value,
            checklist_notes: document.getElementById('checklist_notes').value,
            pillar_code: document.getElementById('pillar_code').value,
            _token: '{{ csrf_token() }}'
        };

        $.post('/admin/checklists', data, function(response) {
            if (response.status === 401) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.data
                });
            } else {
                Swal.fire({
                    icon: 'success',
                    title: 'Data Saved!',
                }).then(() => {
                    location.reload();
                });
            }
        });
    }

    function updateInput(id) {
        const data = {
            checklist_items: document.getElementById('checklist_items').value,
            checklist_notes: document.getElementById('checklist_notes').value,
            pillar_code: document.getElementById('pillar_code').value,
            _token: '{{ csrf_token() }}'
        };

        $.ajax({
            url: `/admin/checklists/${id}`,
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
                        title: 'Data Updated!',
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
            text: 'This action will delete the data permanently!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/admin/checklists/${id}`,
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Data Deleted!',
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Failed to Delete',
                            text: 'There was an error deleting the data.'
                        });
                    }
                });
            }
        });
    }

    function showedit(id) {
        $.get(`/admin/checklists/${id}`, function(data) {
            document.getElementById('checklist_id').value = data.checklist_id;
            document.getElementById('checklist_items').value = data.checklist_items;
            document.getElementById('checklist_notes').value = data.checklist_notes;
            document.getElementById('pillar_code').value = data.pillar_code;
            $('#modalinput').modal('show');
        });
    }
</script>

@endsection

@extends('backend.layouts.master')

@section('title')
Master Approvals - Admin Panel
@endsection

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
                                <li class="breadcrumb-item"><a href='/admin'>Management</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Master Approvals</li>
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
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#modalinput">Tambah Data</button>
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
                                                            <th scope="col">NAME</th>
                                                            <th scope="col">NOTES</th>
                                                            <th scope="col">CODE</th>
                                                            <th scope="col">DEPARTMENT</th>
                                                            <th scope="col">DIVISION</th>
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
                                                                <td>{{ $approval->master_approvals_approval_name }}</td>
                                                                <td>{{ $approval->master_approvals_notes }}</td>
                                                                <td>{{ $approval->master_approvals_code }}</td>
                                                                <td>{{ $approval->division->division_name ?? '-' }}</td>
                                                                <td>{{ $approval->department->department_name ?? '-' }}</td>
                                                                <td>{{ $approval->level->level_name ?? '-' }}</td>
                                                                <td class="text-center">
                                                                    <div class="d-flex justify-content-center gap-2">
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
                <h5 class="modal-title">Form Input</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" id="master_approvals_id">
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
                    <select class="form-control mb-3" id="division_code">
                        <option value="">Select Division</option>
                        @if($divisions)
                            @foreach ($divisions as $division)
                                <option value="{{ $division->division_code }}">{{ $division->division_name }}</option>
                            @endforeach
                        @else
                            <option value="" disabled>No Divisions Available</option>
                        @endif
                    </select>
                    <select class="form-control mb-3" id="department_code">
                        <option value="">Select Department</option>
                        @if($departments)
                            @foreach ($departments as $department)
                                <option value="{{ $department->department_code }}">{{ $department->department_name }}</option>
                            @endforeach
                        @else
                            <option value="" disabled>No Deparment Available</option>
                        @endif
                    </select>
                    <select class="form-control mb-3" id="level_code">
                        <option value="">Select Level</option>
                        @if($levels)
                            @foreach ($levels as $level)
                                <option value="{{ $level->level_code }}">{{ $level->level_name }}</option>
                            @endforeach
                        @else
                            <option value="" disabled>No Levels Available</option>
                        @endif
                    </select>
                    <div class="row">
                        <button type="button" class="btn btn-primary pill mt-3" onclick="save()">
                            Save
                        </button>
                        <button type="button" class="btn btn-secondary2 pill btn-icon" onclick="reload()">
                            <span class="button-content-wrapper">
                                <span class="button-text">
                                    New Data
                                </span>
                                <span class="button-icon">
                                    <i class="ph-arrow-left"></i>
                                </span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function reload() {
        window.open("/admin/master_approvals", "_self");
    }

    function save() {
        const id = document.getElementById('master_approvals_id').value;
        id ? updateInput(id) : saveInput();
    }

    function saveInput() {
    const data = {
        master_approvals_approval_name: document.getElementById('master_approvals_approval_name').value,
        master_approvals_notes: document.getElementById('master_approvals_notes').value,
        division_code: document.getElementById('division_code').value,
        department_code: document.getElementById('department_code').value,
        level_code: document.getElementById('level_code').value,
        _token: '{{ csrf_token() }}'
    };

    $.post('/admin/master_approvals', data, function (response) {
        if (response.status === 401) {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: response.data || 'Failed to save data.'
            });
        } else {
            Swal.fire({
                icon: 'success',
                title: 'Saved!',
                text: 'Data has been saved successfully.'
            }).then(() => {
                location.reload();
            });
        }
    }).fail(function (xhr) {
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: xhr.responseJSON?.message || 'Failed to save data.'
        });
    });
}

function updateInput(id) {
    const data = {
        master_approvals_approval_name: document.getElementById('master_approvals_approval_name').value,
        master_approvals_notes: document.getElementById('master_approvals_notes').value,
        division_code: document.getElementById('division_code').value,
        department_code: document.getElementById('department_code').value,
        level_code: document.getElementById('level_code').value,
        _token: '{{ csrf_token() }}'
    };

    $.ajax({
        url: `/admin/master_approvals/${id}`,
        type: 'PUT',
        data: data,
        success: function (response) {
            if (response.status === 401) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: response.data || 'Failed to update data.'
                });
            } else {
                Swal.fire({
                    icon: 'success',
                    title: 'Updated!',
                    text: 'Data has been updated successfully.'
                }).then(() => {
                    location.reload();
                });
            }
        },
        error: function (xhr) {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: xhr.responseJSON?.message || 'Failed to update data.'
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
            document.getElementById('division_code').value = data.division_code;
            document.getElementById('department_code').value = data.department_code;
            document.getElementById('level_code').value = data.level_code;
            $('#modalinput').modal('show');
        });
    }
</script>
@endsection
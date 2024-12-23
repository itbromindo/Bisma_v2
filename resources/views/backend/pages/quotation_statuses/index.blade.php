@extends('backend.layouts.master')

@section('title')
    Quotation Status Management - Admin Panel
@endsection

@section('admin-content')
<div class="content-wrapper">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 rt-mb-25">
                    <div class="breadcrumbs">
                        <div class="breadcrumb-title">Quotation Status Management</div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href='/admin'>Home</a></li>
                                <li class="breadcrumb-item"><a href='/admin'>Setting</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Quotation Status</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xxl-12 col-xl-12 col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5>Quotation Status</h5>
                            <div class="d-flex align-items-center">
                                <div class="app-main-search me-2">
                                <form action="/admin/quotation_statuses" method="GET" class="d-flex">
                                        <div class="input-box d-flex">
                                            <input type="text" name="search" id="search" value="{{ $search ?? '' }}" class="form-control" placeholder="Search Here">
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
                                                            <th scope="col">Name</th>
                                                            <th scope="col">Notes</th>
                                                            <th scope="col">Code</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($quotation_statuses as $status)
                                                            <tr>
                                                            <td scope="row" class="text-center">
                                                                    {{ ($quotation_statuses->currentPage() - 1) * $quotation_statuses->perPage() + $loop->iteration }}
                                                                </td>
                                                                 <td class="text-center">{{ $status->quotation_status_name }}</td>
                                                                 <td class="text-center">{{ $status->quotation_status_notes }}</td>
                                                                 <td class="text-center">{{ $status->quotation_status_code }}</td>
                                                                <td class="text-center">
                                                                    <div class="d-flex justify-content-center gap-2">
                                                                        <button class="btn btn-light btn-sm border border-danger text-danger" title="Delete" onclick="delete_data('{{ $status->quotation_status_id }}')">
                                                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                <path d="M12.5 3.5L3.5 12.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                                <path d="M12.5 12.5L3.5 3.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                            </svg>
                                                                        </button>
                                                                        <button class="btn btn-light btn-sm border border-success text-success" title="Edit" onclick="showedit('{{ $status->quotation_status_id }}')">
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
                                                <li class="page-item {{ $quotation_statuses->onFirstPage() ? 'disabled' : '' }}">
                                                    <a class="page-link" href="{{ $quotation_statuses->appends(['search' => $search ?? request('search')])->previousPageUrl() }}" aria-label="Previous">
                                                        <i class="ph-arrow-left"></i>
                                                    </a>
                                                </li>

                                                <!-- Page Number Links -->
                                                @foreach ($quotation_statuses->links()->elements[0] as $page => $url)
                                                    <li class="page-item {{ $quotation_statuses->currentPage() == $page ? 'active' : '' }}">
                                                        <a class="page-link" href="{{ $url }}">{{ sprintf('%02d', $page) }}</a>
                                                    </li>
                                                @endforeach

                                                <!-- Next Page Link -->
                                                <li class="page-item {{ $quotation_statuses->hasMorePages() ? '' : 'disabled' }}">
                                                    <a class="page-link" href="{{ $quotation_statuses->appends(['search' => $search ?? request('search')])->nextPageUrl() }}" aria-label="Next">
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
                <h5 class="modal-title" id="exampleModalLongTitle">Quotation Status Form</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" id="quotation_status_id">
                    <div class="formGroup mb-3">
                        <label for="quotation_status_name">Name</label>
                        <input class="form-control" type="text" id="quotation_status_name" placeholder="Enter Status Name" />
                    </div>
                    <div class="formGroup mb-3">
                        <label for="quotation_status_notes">Notes</label>
                        <textarea class="form-control" id="quotation_status_notes" placeholder="Enter Notes"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-warning" onclick="reload()">New Data</button>
                <button type="button" class="btn btn-primary" onclick="save()">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function reload() {
        window.location.reload();
    }

    function save() {
        let id = document.getElementById('quotation_status_id').value;
        if (id == '') {
            saveInput();
        } else {
            updateInput(id);
        }
    }

    function saveInput() {
        var postdata = new FormData();
        postdata.append('_token', document.getElementsByName('_token')[0].defaultValue);
        postdata.append('quotation_status_name', document.getElementById('quotation_status_name').value);
        postdata.append('quotation_status_notes', document.getElementById('quotation_status_notes').value);

        $.ajax({
            type: "POST",
            url: "/admin/quotation_statuses/",
            data: postdata,
            processData: false,
            contentType: false,
            dataType: "json",
            async: false,
            success: function (data) {
                if (data.status == 401) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Form is required!'
                    });
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Successfully saved!'
                    }).then(() => {
                        reload();
                    });
                }
            },
            error: function (dataerror) {
                console.log(dataerror);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred while saving data.'
                });
            }
        });
    }

    function showedit(id) {
        $.ajax({
            type: "GET",
            url: "/admin/quotation_statuses/" + id,
            dataType: "json",
            async: false,
            success: function (data) {
                document.getElementById('quotation_status_id').value = data.quotation_status_id;
                document.getElementById('quotation_status_name').value = data.quotation_status_name;
                document.getElementById('quotation_status_notes').value = data.quotation_status_notes;
                $('#modalinput').modal('show');
            },
            error: function (dataerror) {
                console.log(dataerror);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to fetch data.'
                });
            }
        });
    }

    function updateInput(id) {
        var postdata = new FormData();
        postdata.append('_token', document.getElementsByName('_token')[0].defaultValue);
        postdata.append('quotation_status_name', document.getElementById('quotation_status_name').value);
        postdata.append('quotation_status_notes', document.getElementById('quotation_status_notes').value);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            type: "POST",
            url: "/admin/quotation_statuses/" + id,
            data: postdata,
            processData: false,
            contentType: false,
            dataType: "json",
            async: false,
            success: function (data) {
                if (data.status == 401) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Form is required!'
                    });
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Successfully updated!'
                    }).then(() => {
                        reload();
                    });
                }
            },
            error: function (dataerror) {
                console.log(dataerror);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred while updating data.'
                });
            }
        });
    }

    function delete_data(id) {
        var postdata = {};
        postdata._token = document.getElementsByName('_token')[0].defaultValue;

        Swal.fire({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: "/admin/quotation_statuses/" + id,
                    data: postdata,
                    dataType: "json",
                    async: false,
                    success: function (data) {
                        if (data.status == 401) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Form is required!'
                            });
                        } else {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: 'Data successfully deleted.'
                            }).then(() => {
                                reload();
                            });
                        }
                    },
                    error: function (dataerror) {
                        console.log(dataerror);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'An error occurred while deleting data.'
                        });
                    }
                });
            }
        });
    }
</script>

@endsection
@extends('backend.layouts.master')

@section('title')
Template Win Lose - Admin Panel
@endsection

@section('admin-content')
<div class="content-wrapper">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 rt-mb-25">
                    <div class="breadcrumbs">
                        <div class="breadcrumb-title">Template Win Lose Management</div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href='/admin'>Home</a></li>
                                <li class="breadcrumb-item"><a href='/admin'>Setting</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Template Win Lose</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xxl-12 col-xl-12 col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5>Template Win Lose</h5>
                            <div class="d-flex align-items-center">
                                <div class="app-main-search me-2">
                                    <form action="/admin/template_win_loses" method="GET" class="d-flex">
                                        <div class="input-box d-flex">
                                            <input type="text" name="search" id="search" value="{{ $search ?? '' }}" class="form-control" placeholder="Search Here">
                                            <button type="submit" class="btn btn-light ms-2">
                                                <img src="{{ asset('backend/assets/images/svg/search.svg')}}" alt="Search" draggable="false">
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
                                                            <th scope="col">Title</th>
                                                            <th scope="col">Text</th>
                                                            <th scope="col">Code</th>
                                                            <th scope="col">Notes</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tableBody">
                                                        @foreach ($template_win_loses as $template_win_lose)
                                                            <tr>
                                                            <td scope="row" class="text-center">
                                                                    {{ ($template_win_loses->currentPage() - 1) * $template_win_loses->perPage() + $loop->iteration }}
                                                                </td>
                                                                 <td class="text-center">{{ $template_win_lose->template_win_loses_title }}</td>
                                                                 <td class="text-center">{{ $template_win_lose->template_win_loses_text }}</td>
                                                                 <td class="text-center">{{ $template_win_lose->template_win_loses_code }}</td>
                                                                 <td class="text-center">{{ $template_win_lose->template_win_loses_notes }}</td>
                                                                <td class="text-center">
                                                                    <div class="d-flex justify-content-center gap-2">
                                                                        <button class="btn btn-light btn-sm border border-danger text-danger" title="Delete" onclick="delete_data('{{ $template_win_lose->template_win_loses_id }}')">
                                                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                <path d="M12.5 3.5L3.5 12.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                                <path d="M12.5 12.5L3.5 3.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                            </svg>
                                                                        </button>
                                                                        <button class="btn btn-light btn-sm border border-success text-success" title="Edit" onclick="showedit('{{ $template_win_lose->template_win_loses_id }}')">
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
                                                <li class="page-item {{ $template_win_loses->onFirstPage() ? 'disabled' : '' }}">
                                                    <a class="page-link" href="{{ $template_win_loses->appends(['search' => $search ?? request('search')])->previousPageUrl() }}" aria-label="Previous">
                                                        <i class="ph-arrow-left"></i>
                                                    </a>
                                                </li>

                                                @foreach ($template_win_loses->links()->elements[0] as $page => $url)
                                                    <li class="page-item {{ $template_win_loses->currentPage() == $page ? 'active' : '' }}">
                                                        <a class="page-link" href="{{ $url }}">{{ sprintf('%02d', $page) }}</a>
                                                    </li>
                                                @endforeach

                                                <li class="page-item {{ $template_win_loses->hasMorePages() ? '' : 'disabled' }}">
                                                    <a class="page-link" href="{{ $template_win_loses->appends(['search' => $search ?? request('search')])->nextPageUrl() }}" aria-label="Next">
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
                <h5 class="modal-title" id="exampleModalLongTitle">Form Input</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" id="template_win_loses_id">
                    <div class="formGroup mb-3">
                        <label>Title</label>
                        <input class="form-control" type="text" id="template_win_loses_title" placeholder="Enter Template Title" />
                    </div>
                    <div class="formGroup mb-3">
                        <label>Text</label>
                        <textarea class="form-control" id="template_win_loses_text" placeholder="Enter Template Text"></textarea>
                    </div>
                    <div class="formGroup mb-3">
                        <label>Notes</label>
                        <textarea class="form-control" id="template_win_loses_notes" placeholder="Enter Notes"></textarea>
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

$(document).ready(function () {
        $('#search').on('keyup', function () {
            let searchQuery = $(this).val();
            $.ajax({
                url: '/admin/template_win_loses',
                type: 'GET',
                data: { search: searchQuery },
                success: function (response) {

                    $('#tableBody').html('');
                    if (response.template_win_loses.data.length > 0) {
                        response.template_win_loses.data.forEach(function (template_win_lose, index) {
                            $('#tableBody').append(`
                                <tr>
                                    <td class="text-center">${(response.template_win_loses.current_page - 1) * response.template_win_loses.per_page + index + 1}</td>
                                    <td class="text-center">${template_win_lose.template_win_loses_title}</td>
                                    <td class="text-center">${template_win_lose.template_win_loses_text}</td>
                                    <td class="text-center">${template_win_lose.template_win_loses_code}</td>
                                    <td class="text-center">${template_win_lose.template_win_loses_notes ?? '-'}</td>
                                    <td class="text-center">
                                                                    <div class="d-flex justify-content-center gap-2">
                                                                        <button class="btn btn-light btn-sm border border-danger text-danger" title="Delete" onclick="delete_data('${template_win_lose.template_win_loses_id}')">
                                                                            <svg width="16" height="16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                <path d="M12.5 3.5L3.5 12.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                                <path d="M12.5 12.5L3.5 3.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                            </svg>
                                                                        </button>
                                                                        <button class="btn btn-light btn-sm border border-success text-success" title="Edit" onclick="showedit('${template_win_lose.template_win_loses_id}')">
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
        window.open("/admin/template_win_loses", "_self");
    }

    function save() {
        let id = document.getElementById('template_win_loses_id').value;
        if (id === '') {
            saveInput();
        } else {
            updateInput(id);
        }
    }

    function saveInput() {
        let postdata = new FormData();
        postdata.append('_token', document.getElementsByName('_token')[0].defaultValue);
        postdata.append('template_win_loses_title', document.getElementById('template_win_loses_title').value);
        postdata.append('template_win_loses_text', document.getElementById('template_win_loses_text').value);
        postdata.append('template_win_loses_notes', document.getElementById('template_win_loses_notes').value);

        $.ajax({
            type: "POST",
            url: "/admin/template_win_loses",
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
                        text: 'Form fields are required'
                    });
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Saved',
                        text: 'Data has been saved successfully'
                    }).then(() => {
                        reload();
                    });
                }
            },
            error: function (dataerror) {
                console.log(dataerror);
            }
        });
    }

    function showedit(id) {
        $.ajax({
            type: "GET",
            url: "/admin/template_win_loses/" + id,
            dataType: "json",
            async: false,
            success: function (data) {
                document.getElementById('template_win_loses_id').value = data.template_win_loses_id;
                document.getElementById('template_win_loses_title').value = data.template_win_loses_title;
                document.getElementById('template_win_loses_text').value = data.template_win_loses_text;
                document.getElementById('template_win_loses_notes').value = data.template_win_loses_notes;
                $('#modalinput').modal('show');
            },
            error: function (dataerror) {
                console.log(dataerror);
            }
        });
    }

    function updateInput(id) {
        let postdata = new FormData();
        postdata.append('_token', document.getElementsByName('_token')[0].defaultValue);
        postdata.append('template_win_loses_title', document.getElementById('template_win_loses_title').value);
        postdata.append('template_win_loses_text', document.getElementById('template_win_loses_text').value);
        postdata.append('template_win_loses_notes', document.getElementById('template_win_loses_notes').value);

        $.ajax({
            type: "POST",
            url: "/admin/template_win_loses/" + id,
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
                        text: 'Form fields are required'
                    });
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Updated',
                        text: 'Data has been updated successfully'
                    }).then(() => {
                        reload();
                    });
                }
            },
            error: function (dataerror) {
                console.log(dataerror);
            }
        });
    }

    function delete_data(id) {
        let postdata = {};
        postdata._token = document.getElementsByName('_token')[0].defaultValue;

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
                    type: "DELETE",
                    url: "/admin/template_win_loses/" + id,
                    data: postdata,
                    dataType: "json",
                    async: false,
                    success: function (data) {
                        if (data.status == 401) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Failed to delete data'
                            });
                        } else {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted',
                                text: 'Data has been deleted successfully'
                            }).then(() => {
                                reload();
                            });
                        }
                    },
                    error: function (dataerror) {
                        console.log(dataerror);
                    }
                });
            }
        });
    }
</script>


@endsection
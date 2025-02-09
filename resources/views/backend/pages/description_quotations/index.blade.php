@extends('backend.layouts.master')

@section('title')
Description Quotations - Admin Panel
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
                        <div class="breadcrumb-title"> Description Quotations Management</div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href='/admin'>Home</a></li>
                                <li class="breadcrumb-item"><a href='/admin/description_quotations'>Origin</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><a href='/admin/description_quotations'>Description Quotation</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xxl-12 col-xl-12 col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5>Description Quotations</h5>
                            <div class="d-flex align-items-center">
                                <div class="app-main-search me-2">
                                    <form action="/admin/description_quotations" method="GET" class="d-flex">
                                        <div class="input-box d-flex">
                                            <input type="text" name="search" id="search" value="{{ $search ?? '' }}" class="form-control" placeholder="Search Here">
                                            <button type="submit" class="btn btn-light ms-2">
                                                <img src="{{ asset('backend/assets/images/svg/search.svg')}}" alt="Search" draggable="false">
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                @if ($usr->can('description_quotations.create'))
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
                                                <table class="table align-middle table-basic">
                                                    <thead style="text-align: center">
                                                        <tr>
                                                            <th scope="col">NO</th>
                                                            <th scope="col">Code</th>
                                                            <th scope="col">Title</th>
                                                            <th scope="col">Text</th>
                                                            <th scope="col">Notes</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tableBody">
                                                        @foreach ($description_quotations as $description_quotation)
                                                            <tr>
                                                            <td scope="row" class="text-center">
                                                                    {{ ($description_quotations->currentPage() - 1) * $description_quotations->perPage() + $loop->iteration }}
                                                                </td>
                                                                <td class="text-center">{{ Str::words($description_quotation->template_inquiry_desc_code, 10, '...') }}</td>
                                                                 <td class="text-left">{{ Str::words($description_quotation->template_inquiry_desc_title, 10, '...') }}</td>
                                                                 <td class="text-left">{{ Str::words($description_quotation->template_inquiry_desc_text, 10, '...') }}</td>
                                                                 <td class="text-left">{{ Str::words($description_quotation->template_inquiry_desc_notes, 10, '...') }}</td>
                                                                <td class="text-center">
                                                                    <div class="d-flex justify-content-center gap-2">
                                                                        @if ($usr->can('description_quotations.delete'))
                                                                        <button class="btn btn-light btn-sm border border-danger text-danger" title="Delete" onclick="delete_data('{{ $description_quotation->template_inquiry_desc_id }}')">
                                                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                <path d="M12.5 3.5L3.5 12.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                                <path d="M12.5 12.5L3.5 3.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                            </svg>
                                                                        </button>
                                                                        @endif
                                                                        <button class="btn btn-light btn-sm border border-success text-success" title="Edit" onclick="showedit('{{ $description_quotation->template_inquiry_desc_id }}')">
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
                                                <li class="page-item {{ $description_quotations->onFirstPage() ? 'disabled' : '' }}">
                                                    <a class="page-link" href="{{ $description_quotations->appends(['search' => $search ?? request('search')])->previousPageUrl() }}" aria-label="Previous">
                                                        <i class="ph-arrow-left"></i>
                                                    </a>
                                                </li>

                                                <!-- Page Number Links -->
                                                @foreach ($description_quotations->links()->elements[0] as $page => $url)
                                                    <li class="page-item {{ $description_quotations->currentPage() == $page ? 'active' : '' }}">
                                                        <a class="page-link" href="{{ $url }}">{{ sprintf('%02d', $page) }}</a>
                                                    </li>
                                                @endforeach

                                                <!-- Next Page Link -->
                                                <li class="page-item {{ $description_quotations->hasMorePages() ? '' : 'disabled' }}">
                                                    <a class="page-link" href="{{ $description_quotations->appends(['search' => $search ?? request('search')])->nextPageUrl() }}" aria-label="Next">
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
                    <input type="hidden" id="template_inquiry_desc_id">
                    <div id="alert-container"></div>
                    <div class="fromGroup mb-3">
                    <label>Title</label>
                    <input class="form-control" type="text" id="template_inquiry_desc_title" placeholder="Enter Inquiry Name" />
                </div>
                <div class="fromGroup mb-3">
                    <label>Text</label>
                    <input class="form-control" type="text" id="template_inquiry_desc_text" placeholder="Enter Inquiry Text" />
                </div>
                <div class="fromGroup mb-3">
                    <label>Notes</label>
                    <textarea class="form-control" id="template_inquiry_desc_notes" placeholder="Enter Notes"></textarea>
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                @if ($usr->can('description_quotations.create'))
                <button type="button" class="btn btn-warning" onclick="clearform()">Clear Data</button>
                @endif
                @if ($usr->can('description_quotations.update') || $usr->can('description_quotations.create'))
                <button type="button" id="saveButton" class="btn btn-primary" onclick="save()">Save</button>
                @endif
            </div>
        </div>
    </div>
</div>

<script>

$(document).ready(function () {
    $('#search').on('keyup', function () {
        let searchQuery = $(this).val();
        $.ajax({
            url: '/admin/description_quotations',
            type: 'GET',
            data: { search: searchQuery },
            success: function (response) {
                let tableBody = $('#tableBody');
                tableBody.html('');  // Hapus isi tabel sebelumnya

                if (response.description_quotations.data.length > 0) {
                    response.description_quotations.data.forEach(function (description_quotation, index) {
                        tableBody.append(`
                            <tr>
                                <td class="text-center">${(response.description_quotations.current_page - 1) * response.description_quotations.per_page + index + 1}</td>
                                <td class="text-center">${ truncateText(description_quotation.template_inquiry_desc_code, 10, '...')}</td>
                                <td class="text-left">${ truncateText(description_quotation.template_inquiry_desc_title, 10, '...')}</td>
                                
                                <td class="text-left">${ truncateText(description_quotation.template_inquiry_desc_text, 10, '...') ?? '-'}</td>
                                <td class="text-left">${ truncateText(description_quotation.template_inquiry_desc_notes, 10, '...')}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <button class="btn btn-light btn-sm border border-danger text-danger" title="Delete" onclick="delete_data('${description_quotation.template_inquiry_desc_id}')">
                                            <svg width="16" height="16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12.5 3.5L3.5 12.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M12.5 12.5L3.5 3.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                        <button class="btn btn-light btn-sm border border-success text-success" title="Edit" onclick="showedit('${description_quotation.template_inquiry_desc_id}')">
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
        window.open("/admin/description_quotations", "_self");
    }

    function clearform() {
        document.getElementById('template_inquiry_desc_id').value = '';
        document.getElementById('template_inquiry_desc_title').value = '';
        document.getElementById('template_inquiry_desc_text').value = '';
        document.getElementById('template_inquiry_desc_notes').value = '';
        document.getElementById('saveButton').textContent = 'Save';

        document.getElementById('tittleform').innerHTML = 'Form Input';
    }

    function save() {
        id = document.getElementById('template_inquiry_desc_id').value;
        if (id == '') {
            saveInput();
        } else {
            updateInput(id);
        }
    }

    function saveInput() {
        var postdata = new FormData();
        postdata.append('_token', document.getElementsByName('_token')[0].defaultValue);
        postdata.append('template_inquiry_desc_title', document.getElementById('template_inquiry_desc_title').value);
        postdata.append('template_inquiry_desc_text', document.getElementById('template_inquiry_desc_text').value);
        postdata.append('template_inquiry_desc_notes', document.getElementById('template_inquiry_desc_notes').value);

        $.ajax({
            type: "POST",
            url: "/admin/description_quotations",
            data: postdata,
            processData: false,
            contentType: false,
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

    function showedit(id) {
        $.ajax({
            type: "GET",
            url: "/admin/description_quotations/" + id,
            dataType: "json",
            async: false,
            success: function (data) {
                document.getElementById('template_inquiry_desc_id').value = data.template_inquiry_desc_id;
                document.getElementById('template_inquiry_desc_title').value = data.template_inquiry_desc_title;
                document.getElementById('template_inquiry_desc_text').value = data.template_inquiry_desc_text;
                document.getElementById('template_inquiry_desc_notes').value = data.template_inquiry_desc_notes;
                document.getElementById('tittleform').innerHTML = 'Form Detail & Edit';
                document.getElementById('saveButton').textContent = 'Save Changes';
                $('#modalinput').modal('show');
            },
            error: function (dataerror) {
                console.log(dataerror);
            }
        });
    }

    function updateInput(id) {
        var postdata = new FormData();
        postdata.append('_token', document.getElementsByName('_token')[0].defaultValue);
        postdata.append('template_inquiry_desc_title', document.getElementById('template_inquiry_desc_title').value);
        postdata.append('template_inquiry_desc_text', document.getElementById('template_inquiry_desc_text').value);
        postdata.append('template_inquiry_desc_notes', document.getElementById('template_inquiry_desc_notes').value);

        $.ajax({
            type: "POST",
            url: "/admin/description_quotations/" + id,
            data: postdata,
            processData: false,
            contentType: false,
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
            text: 'Do you want to delete this data?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: "/admin/description_quotations/" + id,
                    data: postdata,
                    dataType: "json",
                    async: false,
                    success: function (data) {
                        if (data.status == 401) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Form fields are required',
                            });
                        } else {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted successfully',
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
@extends('backend.layouts.master')

@section('title')
Origin Inquiries - Admin Panel
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
                        <div class="breadcrumb-title"> Origin Inquiry Management</div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href='/admin'>Home</a></li>
                                <li class="breadcrumb-item"><a href='/admin/origin_inquiries/'>Origin</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><a href='/admin/origin_inquiries/'>Origin Inquiry</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row">
            <div class="col-xxl-12 col-xl-12 col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5>Origin Inquiry</h5>
                            <div class="d-flex align-items-center">
                                <div class="app-main-search me-2">
                                    <form action="/admin/origin_inquiries" method="GET" class="d-flex">
                                        <div class="input-box d-flex">
                                            <input type="text" name="search" id="search" value="{{$search ?? ''}}" class="form-control" placeholder="Search Here">
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
                                        <table class="table align-middle table-basic ">
                                            <thead style="text-align: center">
                                                <tr>
                                                    <th scope="col" width="5%">NO</th>
                                                    <th scope="col">CODE</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Notes</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tableBody">
                                                @foreach ($origin_inquiries as $origin_inquiry)
                                                    <tr>
                                                        <td scope="row" class="text-center">{{ ($origin_inquiries->currentPage() - 1) * $origin_inquiries->perPage() + $loop->iteration }}</td>
                                                        <td class="text-center">{{ $origin_inquiry->origin_inquiry_code }}</td>
                                                        <td class="text-center">{{ $origin_inquiry->origin_inquiry_name }}</td>
                                                        <td class="text-center">{{ $origin_inquiry->origin_inquiry_notes }}</td>
                                                        <td class="text-center">
                                                            <div class="d-flex justify-content-center gap-2">
                                                                <button class="btn btn-light btn-sm border border-danger text-danger" title="Delete" onclick="delete_data('{{ $origin_inquiry->origin_inquiry_id }}')">
                                                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M12.5 3.5L3.5 12.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                        <path d="M12.5 12.5L3.5 3.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                    </svg>
                                                                </button>
                                                                <button class="btn btn-light btn-sm border border-success text-success" title="Edit" onclick="showedit('{{ $origin_inquiry->origin_inquiry_id }}')">
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
                                        <li class="page-item {{ $origin_inquiries->onFirstPage() ? 'disabled' : '' }}">
                                            <a class="page-link" href="{{ $origin_inquiries->appends(['search' => $search ?? request('search')])->previousPageUrl() }}" aria-label="Previous">
                                                <i class="ph-arrow-left"></i>
                                            </a>
                                        </li>

                                        <!-- Page Number Links -->
                                        @foreach ($origin_inquiries->links()->elements[0] as $page => $url)
                                            <li class="page-item {{ $origin_inquiries->currentPage() == $page ? 'active' : '' }}">
                                                <a class="page-link" href="{{ $url }}">{{ sprintf('%02d', $page) }}</a>
                                            </li>
                                        @endforeach

                                        <!-- Next Page Link -->
                                        <li class="page-item {{ $origin_inquiries->hasMorePages() ? '' : 'disabled' }}">
                                            <a class="page-link" href="{{ $origin_inquiries->appends(['search' => $search ?? request('search')])->nextPageUrl() }}" aria-label="Next">
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
                                <input type="hidden" id="origin_inquiry_id">
                                <div id="alert-container"></div>
                                <div class="fromGroup mb-3">
                                    <label>Name</label>
                                    <input class="form-control" type="text" id="origin_inquiry_name" placeholder="Enter Inquiry Name" />
                                </div>
                                <div class="fromGroup mb-3">
                                    <label>Notes</label>
                                    <textarea class="form-control" name="origin_inquiry_notes" id="origin_inquiry_notes" placeholder="Enter Notes"></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            @if ($usr->can('origin_inquiries.create'))
                            <button type="button" class="btn btn-warning" onclick="clearform()">Clear Data</button>
                             @endif   
                            @if ($usr->can('origin_inquiries.update') || $usr->can('origin_inquiries.create'))
                            <button type="button" id= "saveButton" class="btn btn-primary" onclick="save()">Save</button>
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
                url: '/admin/origin_inquiries',
                type: 'GET',
                data: { search: searchQuery },
                success: function (response) {

                    $('#tableBody').html('');
                    if (response.origin_inquiries.data.length > 0) {
                        response.origin_inquiries.data.forEach(function (origin_inquiry, index) {
                            $('#tableBody').append(`
                                <tr>
                                    <td class="text-center">${(response.origin_inquiries.current_page - 1) * response.origin_inquiries.per_page + index + 1}</td>
                                    <td class="text-center">${origin_inquiry.origin_inquiry_code}</td>
                                    <td class="text-center">${origin_inquiry.origin_inquiry_name}</td>
                                    <td class="text-center">${origin_inquiry.origin_inquiry_notes ?? '-'}</td>
                                    
                                    <td class="text-center">
                                                                    <div class="d-flex justify-content-center gap-2">
                                                                        <button class="btn btn-light btn-sm border border-danger text-danger" title="Delete" onclick="delete_data('${origin_inquiry.origin_inquiry_id}')">
                                                                            <svg width="16" height="16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                <path d="M12.5 3.5L3.5 12.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                                <path d="M12.5 12.5L3.5 3.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                            </svg>
                                                                        </button>
                                                                        <button class="btn btn-light btn-sm border border-success text-success" title="Edit" onclick="showedit('${origin_inquiry.origin_inquiry_id}')">
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
        window.open("/admin/origin_inquiries", "_self");
    }

    function clearform() {
        document.getElementById('origin_inquiry_id').value = '';
        document.getElementById('origin_inquiry_name').value = '';
        document.getElementById('origin_inquiry_notes').value = '';
        document.getElementById('saveButton').textContent = 'Save';

        document.getElementById('tittleform').innerHTML = 'Form Input';
    }

    function save() {
        id = document.getElementById('origin_inquiry_id').value;
        if (id == '') {
            saveInput();
        } else {
            updateInput(id);
        }
    }

    function saveInput() {
        var postdata = new FormData();
        postdata.append('_token', document.getElementsByName('_token')[0].defaultValue);
        postdata.append('origin_inquiry_name', document.getElementById('origin_inquiry_name').value); 
        postdata.append('origin_inquiry_notes', document.getElementById('origin_inquiry_notes').value); 

        $.ajax({
            type: "POST",
            url: "/admin/origin_inquiries",
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
            url: "/admin/origin_inquiries/" + id,
            dataType: "json",
            async: false,
            success: function (data) {
                document.getElementById('origin_inquiry_id').value = data.origin_inquiry_id; 
                document.getElementById('origin_inquiry_name').value = data.origin_inquiry_name; 
                document.getElementById('origin_inquiry_notes').value = data.origin_inquiry_notes;
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
        postdata.append('origin_inquiry_name', document.getElementById('origin_inquiry_name').value); 
        postdata.append('origin_inquiry_notes', document.getElementById('origin_inquiry_notes').value); 

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            type: "POST",
            url: "/admin/origin_inquiries/" + id,
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
            eerror: function (dataerror) {
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
        var postdata = {};
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
                    url: "/admin/origin_inquiries/" + id,
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
</script>
@endsection

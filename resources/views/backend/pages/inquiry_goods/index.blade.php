@extends('backend.layouts.master')

@section('title')
Inquiry Goods - Admin Panel
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
                        <div class="breadcrumb-title">Inquiry Goods Management</div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href='/admin'>Home</a></li>
                                <li class="breadcrumb-item"><a href='/admin/inquiry_goods'>Origin</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><a href='/admin/inquiry_goods'>Inquiry Goods</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xxl-12 col-xl-12 col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5>Master Inquiry Goods</h5>
                            <div class="d-flex align-items-center">
                                <div class="app-main-search me-2">
                                    <form action="/admin/inquiry_goods" method="GET" class="d-flex">
                                        <div class="input-box d-flex">
                                            <input type="text" name="search" id="search" value="{{$search ?? ''}}" class="form-control" placeholder="Search Here">
                                            <button type="submit" class="btn btn-light ms-2">
                                                <img src="{{ asset('backend/assets/images/svg/search.svg')}}" alt="Search" draggable="false">
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
                                                            <th scope="col">NOTE</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tableBody">
                                                        @foreach ($inquiry_goods as $item)
                                                            <tr>
                                                                <td scope="row" class="text-center">
                                                                    {{ ($inquiry_goods->currentPage() - 1) * $inquiry_goods->perPage() + $loop->iteration }}
                                                                </td>
                                                                <td class="text-center">{{ Str::words($item->inquiry_goods_status_code, 10, '...') }}</td>
                                                                <td class="text-center">{{ Str::words($item->inquiry_goods_status_name, 10, '...') }}</td>
                                                                <td class="text-left">{{ Str::words($item->inquiry_goods_status_notes, 10, '...') }}</td>
                                                                <td class="text-center">
                                                                    <div class="d-flex justify-content-center gap-2">
                                                                        @if ($usr->can('inquiry_goods.delete'))
                                                                        <button class="btn btn-light btn-sm border border-danger text-danger" title="Delete" onclick="delete_data('{{ $item->inquiry_goods_status_id }}')">
                                                                            <svg width="16" height="16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                <path d="M12.5 3.5L3.5 12.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                                <path d="M12.5 12.5L3.5 3.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                            </svg>
                                                                        </button>
                                                                        @endif
                                                                        <button class="btn btn-light btn-sm border border-success text-success" title="Edit" onclick="showedit('{{ $item->inquiry_goods_status_id }}')">
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
                                                <li class="page-item {{ $inquiry_goods->onFirstPage() ? 'disabled' : '' }}">
                                                    <a class="page-link" href="{{ $inquiry_goods->appends(['search' => $search ?? request('search')])->previousPageUrl() }}" aria-label="Previous">
                                                        <i class="ph-arrow-left"></i>
                                                    </a>
                                                </li>
                                                @foreach ($inquiry_goods->onEachSide(0)->appends(['search' => $search ?? request('search')])->links()->elements[0] as $page => $url)
                                                    <li class="page-item {{ $inquiry_goods->currentPage() == $page ? 'active' : '' }}">
                                                        <a class="page-link" href="{{ $url }}">{{ sprintf('%02d', $page) }}</a>
                                                    </li>
                                                @endforeach
                                                <li class="page-item {{ $inquiry_goods->hasMorePages() ? '' : 'disabled' }}">
                                                    <a class="page-link" href="{{ $inquiry_goods->appends(['search' => $search ?? request('search')])->nextPageUrl() }}" aria-label="Next">
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
                    <input type="hidden" id="inquiry_goods_id">
                    <div id="alert-container"></div>
                    <div class="fromGroup mb-3">
                        <label>Name</label>
                        <input class="form-control" type="text" id="inquiry_goods_status_name" placeholder="Name" />
                    </div>
                    <div class="fromGroup mb-3">
                        <label>Note</label>
                        <textarea class="form-control" id="inquiry_goods_status_notes" placeholder="Note"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                @if ($usr->can('inquiry_goods.create'))
                <button type="button" class="btn btn-warning" onclick="clearForm()">Clear Data</button>
                @endif
                @if ($usr->can('inquiry_goods.update') || $usr->can('inquiry_goods.create'))
                <button type="button" id="saveButton" class="btn btn-primary" onclick="save()">Save</button>
                @endif
            </div>
        </div>
    </div>
</div>


<script>

    function clearForm() {  // tambahan clear data
        document.getElementById('inquiry_goods_id').value = '';
        document.getElementById('inquiry_goods_status_name').value = '';
        document.getElementById('inquiry_goods_status_notes').value = '';
        document.getElementById('tittleform').innerHTML = 'Form Input';
        document.getElementById('saveButton').textContent = 'Save';
    }

    $(document).ready(function () {
        $('#search').on('keyup', function () {
            let searchQuery = $(this).val();
            $.ajax({
                url: '/admin/inquiry_goods',
                type: 'GET',
                data: { search: searchQuery },
                success: function (response) {

                    $('#tableBody').html('');
                    if (response.inquiry_goods.data.length > 0) {
                        response.inquiry_goods.data.forEach(function (item, index) {
                            $('#tableBody').append(`
                                <tr>
                                    <td class="text-center">${(response.inquiry_goods.current_page - 1) * response.inquiry_goods.per_page + index + 1}</td>
                                    <td class="text-center">${ truncateText(item.inquiry_goods_status_code, 10, '...')}</td>
                                    <td class="text-center">${ truncateText(item.inquiry_goods_status_name, 10, '...')}</td>
                                    <td class="text-left">${ truncateText(item.inquiry_goods_status_notes, 10, '...') ?? ''}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <button class="btn btn-light btn-sm border border-danger text-danger" title="Delete" onclick="delete_data('${item.inquiry_goods_status_id}')">
                                                <svg width="16" height="16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12.5 3.5L3.5 12.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M12.5 12.5L3.5 3.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </button>
                                            <button class="btn btn-light btn-sm border border-success text-success" title="Edit" onclick="showedit('${item.inquiry_goods_status_id}')">
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
        window.open("/admin/inquiry_goods", "_self");
    }

    function save() {
        const id = document.getElementById('inquiry_goods_id').value;
        id ? updateInput(id) : saveInput();
    }

    function saveInput() {
        var postdata = new FormData();
        // Tambahkan token CSRF
        postdata.append('_token', document.getElementsByName('_token')[0].defaultValue);
        postdata.append('inquiry_goods_status_name', document.getElementById('inquiry_goods_status_name').value); 
        postdata.append('inquiry_goods_status_notes', document.getElementById('inquiry_goods_status_notes').value); 

        $.ajax({
            type: "POST",
            url: "/admin/inquiry_goods",
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
        postdata.append('inquiry_goods_status_name', document.getElementById('inquiry_goods_status_name').value); 
        postdata.append('inquiry_goods_status_notes', document.getElementById('inquiry_goods_status_notes').value); 
        // console.log('Data FormData: ', Array.from(postdata.entries()));
        

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            type: "POST",
            url: "/admin/inquiry_goods/"+id,
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
                    url: `/admin/inquiry_goods/${id}`,
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: 'Data has been deleted.',
                        }).then(function() {
                            location.reload();
                        });
                    }
                });
            }
        });
    }

    function showedit(id) {
        $.get(`/admin/inquiry_goods/${id}`, function(data) {
            document.getElementById('inquiry_goods_id').value = data.inquiry_goods_status_id;
            document.getElementById('inquiry_goods_status_name').value = data.inquiry_goods_status_name;
            document.getElementById('inquiry_goods_status_notes').value = data.inquiry_goods_status_notes;
            document.getElementById('tittleform').innerHTML = 'Form Detail & Edit';
            document.getElementById('saveButton').textContent = 'Save Changes';
            $('#modalinput').modal('show');
        });
    }
</script>

@endsection

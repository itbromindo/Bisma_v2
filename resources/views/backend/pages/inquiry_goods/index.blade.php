@extends('backend.layouts.master')

@section('title')
Inquiry Goods - Admin Panel
@endsection

@section('admin-content')
<div class="content-wrapper">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 rt-mb-25">
                    <div class="breadcrumbs">
                        <div class="breadcrumb-title">Master</div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href='/admin'>Home</a></li>
                                <li class="breadcrumb-item"><a href='/admin'>Master</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Inquiry Goods</li>
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
                                                                <td class="text-center">{{ $item->inquiry_goods_status_code }}</td>
                                                                 <td class="text-center">{{ $item->inquiry_goods_status_name }}</td>
                                                                 <td class="text-center">{{ $item->inquiry_goods_status_notes }}</td>
                                                                <td class="text-center">
                                                                    <div class="d-flex justify-content-center gap-2">
                                                                        <button class="btn btn-light btn-sm border border-danger text-danger" title="Delete" onclick="delete_data('{{ $item->inquiry_goods_status_id }}')">
                                                                            <svg width="16" height="16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                <path d="M12.5 3.5L3.5 12.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                                <path d="M12.5 12.5L3.5 3.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                            </svg>
                                                                        </button>
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
                <h5 class="modal-title">Form Input</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" id="inquiry_goods_id">
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
                <button type="button" class="btn btn-warning" onclick="clearForm()">Clear Data</button>
                <button type="button" class="btn btn-primary" onclick="save()">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

    function clearForm() {  // tambahan clear data
        document.getElementById('inquiry_goods_id').value = '';
        document.getElementById('inquiry_goods_status_name').value = '';
        document.getElementById('inquiry_goods_status_notes').value = '';
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
                                    <td class="text-center">${item.inquiry_goods_status_code}</td>
                                    <td class="text-center">${item.inquiry_goods_status_name}</td>
                                    <td class="text-center">${item.inquiry_goods_status_notes ?? '-'}</td>
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
        const data = {
            inquiry_goods_status_name: document.getElementById('inquiry_goods_status_name').value,
            inquiry_goods_status_notes: document.getElementById('inquiry_goods_status_notes').value,
            _token: '{{ csrf_token() }}'
        };

        $.post('/admin/inquiry_goods', data, function(response) {
            if (response.status === 401) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.data
                });
            } else {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Data Saved!',
                }).then(function() {
                    location.reload();
                });
            }
        });
    }

    function updateInput(id) {
        const data = {
            inquiry_goods_status_name: document.getElementById('inquiry_goods_status_name').value,
            inquiry_goods_status_notes: document.getElementById('inquiry_goods_status_notes').value,
            _token: '{{ csrf_token() }}'
        };

        $.ajax({
            url: `/admin/inquiry_goods/${id}`,
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
                        title: 'Success',
                        text: 'Data Updated!',
                    }).then(function() {
                        location.reload();
                    });
                }
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
            $('#modalinput').modal('show');
        });
    }
</script>

@endsection

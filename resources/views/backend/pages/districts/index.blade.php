@extends('backend.layouts.master')

@section('title')
Districts - Admin Panel
@endsection

@section('admin-content')
<div class="content-wrapper">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 rt-mb-25">
                    <div class="breadcrumbs">
                        <div class="breadcrumb-title">District Management</div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href='/admin'>Home</a></li>
                                <li class="breadcrumb-item"><a href='/admin/districts'>Location</a></li>
                                <li class="breadcrumb-item"><a href='/admin/districts'>District</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xxl-12 col-xl-12 col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5>Master Districts</h5>
                            <div class="d-flex align-items-center">
                                <div class="app-main-search me-2">
                                    <form action="/admin/districts" method="GET" class="d-flex">
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
                                                            <th scope="col">CODE</th>
                                                            <th scope="col">NAME</th>
                                                            <th scope="col">NOTES</th>
                                                            <th scope="col">CITY</th>
                                                            
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tableBody">
                                                        @foreach ($districts as $district)
                                                            <tr>
                                                                <td scope="row" class="text-center">
                                                                    {{ ($districts->currentPage() - 1) * $districts->perPage() + $loop->iteration }}
                                                                </td>
                                                                <td class="text-center">{{ $district->districts_code }}</td>
                                                                 <td class="text-center">{{ $district->districts_name }}</td>
                                                                 <td class="text-center">{{ $district->districts_notes }}</td>
                                                                 <td class="text-center">{{ $district->city->cities_name ?? '-' }}</td>
                                                                 
                                                                <td class="text-center">
                                                                    <div class="d-flex justify-content-center gap-2">
                                                                        <button class="btn btn-light btn-sm border border-danger text-danger" title="Delete" onclick="delete_data('{{ $district->districts_id }}')">
                                                                            <svg width="16" height="16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                <path d="M12.5 3.5L3.5 12.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                                <path d="M12.5 12.5L3.5 3.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                            </svg>
                                                                        </button>
                                                                        <button class="btn btn-light btn-sm border border-success text-success" title="Edit" onclick="showedit('{{ $district->districts_id }}')">
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
                                                <li class="page-item {{ $districts->onFirstPage() ? 'disabled' : '' }}">
                                                    <a class="page-link" href="{{ $districts->previousPageUrl() }}" aria-label="Previous">
                                                        <i class="ph-arrow-left"></i>
                                                    </a>
                                                </li>

                                                @foreach ($districts->onEachSide(0)->links()->elements[0] as $page => $url)
                                                    <li class="page-item {{ $districts->currentPage() == $page ? 'active' : '' }}">
                                                        <a class="page-link" href="{{ $url }}">{{ sprintf('%02d', $page) }}</a>
                                                    </li>
                                                @endforeach

                                                <li class="page-item {{ $districts->hasMorePages() ? '' : 'disabled' }}">
                                                    <a class="page-link" href="{{ $districts->nextPageUrl() }}" aria-label="Next">
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
                    <input type="hidden" id="districts_id">
                    <div class="form-group mb-3">
                        <label>District Name</label>
                        <input class="form-control" type="text" id="districts_name" placeholder="District Name" />
                    </div>
                    <div class="form-group mb-3">
                        <label>Notes</label>
                        <textarea class="form-control" id="districts_notes" placeholder="Notes"></textarea>
                    </div>
                    <select class="form-control mb-3" id="cities_code">
                        <option value="">Select City</option>
                        @foreach ($cities as $city)
                            <option value="{{ $city->cities_code }}">{{ $city->cities_name }}</option>
                        @endforeach
                    </select>
                    <!-- <div class="fromGroup mb-3">
                        <label>Status</label>
                        <select class="form-control" id="districts_status">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div> -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-warning" onclick="clearForm()">Clear Data</button>
                        <button type="button" id="saveButton" class="btn btn-primary" onclick="save()">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

    function clearForm() {  // tambahan clear data
        document.getElementById('districts_id').value = '';
        document.getElementById('districts_name').value = '';
        document.getElementById('districts_notes').value = '';
        document.getElementById('cities_code').value = '';
        document.getElementById('saveButton').textContent = 'Save';
    }

$(document).ready(function () {
        $('#search').on('keyup', function () {
            let searchQuery = $(this).val();
            $.ajax({
                url: '/admin/districts',
                type: 'GET',
                data: { search: searchQuery },
                success: function (response) {

                    $('#tableBody').html('');
                    if (response.districts.data.length > 0) {
                        response.districts.data.forEach(function (district, index) {
                            $('#tableBody').append(`
                                <tr>
                                    <td class="text-center">${(response.districts.current_page - 1) * response.districts.per_page + index + 1}</td>
                                    <td class="text-center">${district.districts_code}</td>
                                    <td class="text-center">${district.districts_name}</td>
                                    <td class="text-center">${district.districts_notes ?? '-'}</td>
                                    <td class="text-center">${district.city ? district.city.cities_name : '-'}</td>
                                    
                                    <td class="text-center">
                                                                    <div class="d-flex justify-content-center gap-2">
                                                                        <button class="btn btn-light btn-sm border border-danger text-danger" title="Delete" onclick="delete_data('${district.districts_id}')">
                                                                            <svg width="16" height="16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                <path d="M12.5 3.5L3.5 12.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                                <path d="M12.5 12.5L3.5 3.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                            </svg>
                                                                        </button>
                                                                        <button class="btn btn-light btn-sm border border-success text-success" title="Edit" onclick="showedit('${district.districts_id}')">
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
        window.open("/admin/districts", "_self");
    }

    function save() {
        const id = document.getElementById('districts_id').value;
        id ? updateInput(id) : saveInput();
    }

    function saveInput() {
        const data = {
            districts_name: document.getElementById('districts_name').value,
            districts_notes: document.getElementById('districts_notes').value,
            cities_code: document.getElementById('cities_code').value,
            // districts_status: document.getElementById('districts_status').value,
            _token: '{{ csrf_token() }}'
        };

        $.post('/admin/districts', data, function(response) {
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
            districts_name: document.getElementById('districts_name').value,
            districts_notes: document.getElementById('districts_notes').value,
            cities_code: document.getElementById('cities_code').value,
            // districts_status: document.getElementById('districts_status').value,
            _token: '{{ csrf_token() }}'
        };

        $.ajax({
            url: `/admin/districts/${id}`,
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
                    url: `/admin/districts/${id}`,
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
        $.get(`/admin/districts/${id}`, function(data) {
            document.getElementById('districts_id').value = data.districts_id;
            document.getElementById('districts_name').value = data.districts_name;
            document.getElementById('districts_notes').value = data.districts_notes;
            document.getElementById('cities_code').value = data.cities_code;
            document.getElementById('saveButton').textContent = 'Save Changes';
            // document.getElementById('districts_status').value = data.districts_status;
            $('#modalinput').modal('show');
        });
    }
</script>

@endsection

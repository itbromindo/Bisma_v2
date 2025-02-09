@extends('backend.layouts.master')

@section('title')
Cities - Admin Panel
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
                        <div class="breadcrumb-title">City Management</div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href='/admin'>Home</a></li>
                                <li class="breadcrumb-item"><a href='/admin/cities'>Location</a></li>
                                <li class="breadcrumb-item"><a href='/admin/cities'>City</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xxl-12 col-xl-12 col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5>Master Cities</h5>
                            <div class="d-flex align-items-center">
                                <div class="app-main-search me-2">
                                    <form action="/admin/cities" method="GET" class="d-flex">
                                        <div class="input-box d-flex">
                                            <input type="text" name="search" id="search" value="{{$search ?? ''}}"
                                                class="form-control" placeholder="Search Here">
                                            <button type="submit" class="btn btn-light ms-2">
                                                <img src="{{ asset('backend/assets/images/svg/search.svg') }}"
                                                    alt="Search" draggable="false">
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                @if ($usr->can('cities.create'))
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#modalinput" onclick="clearForm()">Tambah Data</button>
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
                                                            <th scope="col">NOTES</th>
                                                            <th scope="col">PROVINCE</th>
                                                            <!-- <th scope="col">Status</th> -->
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tableBody">
                                                        @foreach ($cities as $city)
                                                            <tr>
                                                                <td scope="row" class="text-center">
                                                                    {{ ($cities->currentPage() - 1) * $cities->perPage() + $loop->iteration }}
                                                                </td>
                                                                <td class="text-center">{{ Str::words($city->cities_code, 10, '...') }}</td>
                                                                <td class="text-center">{{ Str::words($city->cities_name, 10, '...') }}</td>
                                                                <td class="text-left">{{ Str::words($city->cities_notes, 10, '...') }}</td>
                                                                <td class="text-center">
                                                                    {{ $city->province->provinces_name ?? '-' }}</td>
                                                                <!-- <td class="text-center">{{ $city->cities_status }}</td> -->
                                                                <td class="text-center">
                                                                    <div class="d-flex justify-content-center gap-2">
                                                                        @if ($usr->can('cities.delete'))
                                                                        <button
                                                                            class="btn btn-light btn-sm border border-danger text-danger"
                                                                            title="Delete"
                                                                            onclick="delete_data('{{ $city->cities_id }}')">
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
                                                                        @endif
                                                                        <button
                                                                            class="btn btn-light btn-sm border border-success text-success"
                                                                            title="Edit"
                                                                            onclick="showedit('{{ $city->cities_id }}')">
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
                                                <li class="page-item {{ $cities->onFirstPage() ? 'disabled' : '' }}">
                                                    <a class="page-link" href="{{ $cities->previousPageUrl() }}"
                                                        aria-label="Previous">
                                                        <i class="ph-arrow-left"></i>
                                                    </a>
                                                </li>

                                                @foreach ($cities->onEachSide(0)->links()->elements[0] as $page => $url)
                                                    <li
                                                        class="page-item {{ $cities->currentPage() == $page ? 'active' : '' }}">
                                                        <a class="page-link"
                                                            href="{{ $url }}">{{ sprintf('%02d', $page) }}</a>
                                                    </li>
                                                @endforeach

                                                <li class="page-item {{ $cities->hasMorePages() ? '' : 'disabled' }}">
                                                    <a class="page-link" href="{{ $cities->nextPageUrl() }}"
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
<div class="modal fade" id="modalinput" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                    <input type="hidden" id="city_id">
                    <div id="alert-container"></div>
                    <div class="form-group mb-3">
                        <label>City Name</label>
                        <input class="form-control" type="text" id="cities_name" placeholder="City Name" />
                    </div>
                    <div class="form-group mb-3">
                        <label>Notes</label>
                        <textarea class="form-control" id="cities_notes" placeholder="Notes"></textarea>
                    </div>
                    <div class="fromGroup mb-3">
                        <label>Province</label>
                        {{-- <input class="form-control" type="text" id="moduls_code" placeholder="Code Modul" /> --}}
                            <select class="form-control" id="provinces_code" style="width: 100%;">
                                <option value="" disabled selected>Pilih Province</option>
                            </select>
                    </div>
                    <!-- <div class="fromGroup mb-3">
                        <label>Status</label>
                        <select class="form-control" id="cities_status">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div> -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        @if ($usr->can('cities.create'))
                        <button type="button" class="btn btn-warning" onclick="clearForm()">Clear Data</button>
                        @endif
                        @if ($usr->can('cities.update') || $usr->can('cities.create'))
                        <button type="button" id="saveButton" class="btn btn-primary" onclick="save()">Save</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function() {        
        $('#modalinput').on('shown.bs.modal', function () {
            $('#provinces_code').select2({
                dropdownParent: $('#modalinput'),
                placeholder: "Pilih Province",
                allowClear: true,
                ajax: {
                    url: '/admin/comboprovinces',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            search: params.term // Parameter pencarian
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    }
                }
            });
        });

        // Fokuskan input pencarian Select2
        $('#provinces_code').on('select2:open', function () {
            document.querySelector('.select2-search__field').focus();
        });
    });

    function clearForm() {  // tambahan clear data
        document.getElementById('city_id').value = '';
        document.getElementById('cities_name').value = '';
        document.getElementById('cities_notes').value = '';
        $('#provinces_code').append(new Option('', '', true, true)).trigger('change');
        document.getElementById('tittleform').innerHTML = 'Form Input';
        document.getElementById('saveButton').textContent = 'Save';
        
    }

    $(document).ready(function () {
        $('#search').on('keyup', function () {
            let searchQuery = $(this).val();
            $.ajax({
                url: '/admin/cities',
                type: 'GET',
                data: { search: searchQuery },
                success: function (response) {

                    $('#tableBody').html('');
                    if (response.cities.data.length > 0) {
                        response.cities.data.forEach(function (city, index) {
                            $('#tableBody').append(`
                                <tr>
                                    <td class="text-center">${(response.cities.current_page - 1) * response.cities.per_page + index + 1}</td>
                                    <td class="text-center">${ truncateText(city.cities_code, 10, '...')}</td>
                                    <td class="text-center">${ truncateText(city.cities_name, 10, '...')}</td>
                                    <td class="text-left">${ truncateText(city.cities_notes, 10, '...') ?? ''}</td>
                                    <td class="text-center">${ truncateText(city.province, 10, '...') ? city.province.provinces_name : ''}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            @if ($usr->can('cities.delete'))
                                            <button class="btn btn-light btn-sm border border-danger text-danger" title="Delete" onclick="delete_data('${city.cities_id}')">
                                                <svg width="16" height="16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12.5 3.5L3.5 12.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M12.5 12.5L3.5 3.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </button>
                                            @endif
                                            <button class="btn btn-light btn-sm border border-success text-success" title="Edit" onclick="showedit('${city.cities_id}')">
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
        window.open("/admin/cities", "_self");
    }

    function save() {
        const id = document.getElementById('city_id').value;
        id ? updateInput(id) : saveInput();
    }

    function saveInput() {
        var postdata = new FormData();
        // Tambahkan token CSRF
        postdata.append('_token', document.getElementsByName('_token')[0].defaultValue);
        postdata.append('cities_name', document.getElementById('cities_name').value); 
        postdata.append('cities_notes', document.getElementById('cities_notes').value); 
        postdata.append('provinces_code', document.getElementById('provinces_code').value); 

        $.ajax({
            type: "POST",
            url: "/admin/cities",
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
        postdata.append('cities_name', document.getElementById('cities_name').value); 
        postdata.append('cities_notes', document.getElementById('cities_notes').value); 
        postdata.append('provinces_code', document.getElementById('provinces_code').value); 
        // console.log('Data FormData: ', Array.from(postdata.entries()));
        

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            type: "POST",
            url: "/admin/cities/"+id,
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
                    url: `/admin/cities/${id}`,
                    type: 'DELETE',
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

    function showedit(id) {
        $.get(`/admin/cities/${id}`, function (data) {
            document.getElementById('city_id').value = data.cities_id;
            document.getElementById('cities_name').value = data.cities_name;
            document.getElementById('cities_notes').value = data.cities_notes;
            $('#provinces_code').append(new Option(data.provinces_name, data.provinces_code, true, true)).trigger('change');
            document.getElementById('tittleform').innerHTML = 'Form Detail & Edit';
            document.getElementById('saveButton').textContent = 'Save Changes';
            // document.getElementById('cities_status').value = data.cities_status;
            $('#modalinput').modal('show');
        });
    }
</script>

@endsection
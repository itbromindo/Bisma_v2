@extends('backend.layouts.master')

@section('title')
Shifts - Admin Panel
@endsection

@section('admin-content')
<div class="content-wrapper">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 rt-mb-25">
                    <div class="breadcrumbs">
                        <div class="breadcrumb-title">Shift Management</div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href='/admin'>Home</a></li>
                                <li class="breadcrumb-item"><a href='/admin'>Management</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Shifts</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xxl-12 col-xl-12 col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5>Master Shifts</h5>
                            <div class="d-flex align-items-center">
                                <div class="app-main-search me-2">
                                    <form action="/admin/shifts" method="GET" class="d-flex">
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
                                                            <th scope="col">SHIFT NAME</th>
                                                            <th scope="col">COMPANY</th>
                                                            <th scope="col">START BEFORE BREAK</th>
                                                            <th scope="col">END BEFORE BREAK</th>
                                                            <th scope="col">START AFTER BREAK</th>
                                                            <th scope="col">END AFTER BREAK</th>
                                                            <th scope="col">NOTES</th>
                                                            <th scope="col">ACTION</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tableBody">
                                                        @foreach ($shifts as $shift)
                                                            <tr>
                                                                <td scope="row" class="text-center">
                                                                    {{ ($shifts->currentPage() - 1) * $shifts->perPage() + $loop->iteration }}
                                                                </td>
                                                                <td>{{ $shift->shift_name }}</td>
                                                                <td>{{ $shift->company->companies_name ?? '-' }}</td>
                                                                <td>{{ $shift->shift_start_time_before_break }}</td>
                                                                <td>{{ $shift->shift_end_time_before_break }}</td>
                                                                <td>{{ $shift->shift_start_time_after_break }}</td>
                                                                <td>{{ $shift->shift_end_time_after_break }}</td>
                                                                <td>{{ $shift->shift_notes }}</td>
                                                                <td class="text-center">
                                                                    <div class="d-flex justify-content-center gap-2">
                                                                        <button
                                                                            class="btn btn-light btn-sm border border-danger text-danger"
                                                                            title="Delete"
                                                                            onclick="delete_data('{{ $shift->shift_id }}')">
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
                                                                            onclick="showedit('{{ $shift->shift_id }}')">
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
                                                <li class="page-item {{ $shifts->onFirstPage() ? 'disabled' : '' }}">
                                                    <a class="page-link"
                                                        href="{{ $shifts->appends(['search' => $search ?? request('search')])->previousPageUrl() }}"
                                                        aria-label="Previous">
                                                        <i class="ph-arrow-left"></i>
                                                    </a>
                                                </li>

                                                @foreach ($shifts->onEachSide(0)->appends(['search' => $search ?? request('search')])->links()->elements[0] as $page => $url)
                                                    <li
                                                        class="page-item {{ $shifts->currentPage() == $page ? 'active' : '' }}">
                                                        <a class="page-link"
                                                            href="{{ $url }}">{{ sprintf('%02d', $page) }}</a>
                                                    </li>
                                                @endforeach

                                                <li class="page-item {{ $shifts->hasMorePages() ? '' : 'disabled' }}">
                                                    <a class="page-link"
                                                        href="{{ $shifts->appends(['search' => $search ?? request('search')])->nextPageUrl() }}"
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
                    <input type="hidden" id="shift_id">
                    <div class="formGroup mb-3">
                        <label>Shift Name</label>
                        <input class="form-control" type="text" id="shift_name" placeholder="Shift Name" />
                    </div>
                    <div class="formGroup mb-3">
                        <label>Notes</label>
                        <textarea class="form-control" name="shift_notes" id="shift_notes"
                            placeholder="Notes"></textarea>
                    </div>
                    <div class="formGroup mb-3">
                        <label>Start Time Before Break</label>
                        <input class="form-control" type="time" id="shift_start_time_before_break"
                            placeholder="Start Time Before Break" />
                    </div>
                    <div class="formGroup mb-3">
                        <label>End Time Before Break</label>
                        <input class="form-control" type="time" id="shift_end_time_before_break"
                            placeholder="End Time Before Break" />
                    </div>
                    <div class="formGroup mb-3">
                        <label>Start Time After Break</label>
                        <input class="form-control" type="time" id="shift_start_time_after_break"
                            placeholder="Start Time After Break" />
                    </div>
                    <div class="formGroup mb-3">
                        <label>End Time After Break</label>
                        <input class="form-control" type="time" id="shift_end_time_after_break"
                            placeholder="End Time After Break" />
                    </div>
                    <select class="form-control mb-3" id="companies_code">
                        <option value="">Select Company</option>
                        @if($companies)
                            @foreach ($companies as $company)
                                <option value="{{ $company->companies_code }}">{{ $company->companies_name }}</option>
                            @endforeach
                        @else
                            <option value="" disabled>No Companies Available</option>
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
        window.open("/admin/shifts", "_self");
    }

    function save() {
        const id = document.getElementById('shift_id').value;
        id ? updateInput(id) : saveInput();
    }

    function formatTime(time) {
        const [hour, minute] = time.split(':');
        return `${hour}:${minute}`;
    }

    function saveInput() {
        const data = {
            shift_name: document.getElementById('shift_name').value,
            shift_notes: document.getElementById('shift_notes').value,
            shift_start_time_before_break: document.getElementById('shift_start_time_before_break').value,
            shift_end_time_before_break: document.getElementById('shift_end_time_before_break').value,
            shift_start_time_after_break: document.getElementById('shift_start_time_after_break').value,
            shift_end_time_after_break: document.getElementById('shift_end_time_after_break').value,
            companies_code: document.getElementById('companies_code').value,
            _token: '{{ csrf_token() }}'
        };

        $.post('/admin/shifts', data, function (response) {
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
                }).then(function () {
                    location.reload();
                });
            }
        });
    }

    function updateInput(id) {
        const shiftStartBeforeBreak = document.getElementById('shift_start_time_before_break').value;
        const shiftEndBeforeBreak = document.getElementById('shift_end_time_before_break').value;
        const shiftStartAfterBreak = document.getElementById('shift_start_time_after_break').value;
        const shiftEndAfterBreak = document.getElementById('shift_end_time_after_break').value;

        const data = {
            shift_name: document.getElementById('shift_name').value,
            shift_notes: document.getElementById('shift_notes').value,
            shift_start_time_before_break: formatTime(shiftStartBeforeBreak),
            shift_end_time_before_break: formatTime(shiftEndBeforeBreak),
            shift_start_time_after_break: formatTime(shiftStartAfterBreak),
            shift_end_time_after_break: formatTime(shiftEndAfterBreak),
            companies_code: document.getElementById('companies_code').value,
            _token: '{{ csrf_token() }}'
        };

        $.ajax({
            url: `/admin/shifts/${id}`,
            type: 'PUT',
            data: data,
            success: function (response) {
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
                    }).then(function () {
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
                    url: `/admin/shifts/${id}`,
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
        $.get(`/admin/shifts/${id}`, function (data) {
            document.getElementById('shift_id').value = data.shift_id;
            document.getElementById('shift_name').value = data.shift_name;
            document.getElementById('shift_notes').value = data.shift_notes;
            document.getElementById('shift_start_time_before_break').value = data.shift_start_time_before_break;
            document.getElementById('shift_end_time_before_break').value = data.shift_end_time_before_break;
            document.getElementById('shift_start_time_after_break').value = data.shift_start_time_after_break;
            document.getElementById('shift_end_time_after_break').value = data.shift_end_time_after_break;
            document.getElementById('companies_code').value = data.companies_code;
            $('#modalinput').modal('show');
        });
    }
</script>

@endsection
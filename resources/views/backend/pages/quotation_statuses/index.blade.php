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
                                <li class="breadcrumb-item"><a href='/admin'>Settings</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Quotation Status</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Table Section -->
                <div class="col-xxl-8 col-xl-8 col-md-8">
                    <section class="tables">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-wrapper">
                                    <div class="table-content table-responsive">
                                        <table class="table align-middle table-basic">
                                            <thead style="text-align: center">
                                                <tr>
                                                    <th scope="col">NO</th>
                                                    <th scope="col">CODE</th>
                                                    <th scope="col">NAME</th>
                                                    <th scope="col">NOTES</th>
                                                    <!-- <th scope="col">STATUS</th> -->
                                                    <th scope="col">ACTIONS</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($quotation_statuses as $status)
                                                    <tr>
                                                        <td scope="row">{{ $loop->iteration }}</td>
                                                        <td>{{ $status->quotation_status_code }}</td>
                                                        <td>{{ $status->quotation_status_name }}</td>
                                                        <td>{{ $status->quotation_status_notes }}</td>
                                                        <!-- <td>{{ $status->is_deleted ? 'Deleted' : 'Active' }}</td> -->
                                                        <td>
                                                            <ul class="action-btn">
                                                            <li>
                                                                    <button onclick="deleteData('{{ $status->quotation_status_id }}')">
                                                                        <svg width="16" height="16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M12.5 3.5L3.5 12.5M3.5 3.5L12.5 12.5" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                        </svg>
                                                                    </button>
                                                                </li>
                                                                <li>
                                                                    <button title="Edit" onclick="showedit('{{ $status->quotation_status_id }}')">
                                                                        <svg width="16" height="16" viewBox="0 0 16 16"
                                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M12.1464 1.85355C12.3417 1.65829 12.6583 1.65829 12.8536 1.85355L14.1464 3.14645C14.3417 3.34171 14.3417 3.65829 14.1464 3.85355L5.35355 12.6464L2.5 13.5L3.35355 10.6464L12.1464 1.85355Z" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                    
                                                                        <path d="M11.5 2.5L13.5 4.5" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />                                                </svg>
                                                                    </button>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    {{ $quotation_statuses->links() }} <!-- Pagination -->
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

                <div class="col-xxl-4 col-xl-4 col-md-4">
    <div class="card">
        <div class="card-header">Form Input</div>
        <div class="card-body">
            <form>
                <input type="hidden" id="quotation_status_id">
                <div class="form-group mb-3">
                    <label>Name</label>
                    <input class="form-control" type="text" id="quotation_status_name" placeholder="Enter Name" name="quotation_status_name" required>
                </div>
                <div class="form-group mb-3">
                    <label>Notes</label>
                    <textarea class="form-control" id="quotation_status_notes" placeholder="Enter Notes" name="quotation_status_notes"></textarea>
                </div>
                <div class="row">
                    <button type="button" class="btn btn-primary pill mt-3" onclick="save()">
                        Save
                    </button>
                    <button type="button" class="btn btn-secondary2 pill btn-icon" onclick="reload()">
                        <span class="button-content-wrapper">
                            <span class="button-text">New Data</span>
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

<script>
    function reload() {
        window.open("/admin/quotation_statuses", "_self");
    }

    function save() {
        let id = document.getElementById('quotation_status_id').value;
        if (id === '') {
            saveInput();
        } else {
            updateInput(id);
        }
    }

    function saveInput() {
        let postdata = new FormData();
        postdata.append('_token', document.getElementsByName('_token')[0].defaultValue);
        postdata.append('quotation_status_name', document.getElementById('quotation_status_name').value);
        postdata.append('quotation_status_notes', document.getElementById('quotation_status_notes').value);

        $.ajax({
            type: "POST",
            url: "/admin/quotation_statuses",
            data: postdata,
            processData: false,
            contentType: false,
            dataType: "json",
            async: false,
            success: function (data) {
                if (data.status === 401) {
                    alert('Form fields are required.');
                } else if (data.status === 501) {
                    alert(data.message);
                } else {
                    alert('Saved successfully.');
                    setTimeout(() => {
                        window.open("/admin/quotation_statuses", "_self");
                    }, 500);
                }
            },
            error: function (error) {
                console.error(error);
            }
        });
    }

    function showedit(id) {
        $.ajax({
            type: "GET",
            url: "/admin/quotation_statuses/"+id,
            dataType: "json",
            async: false,
            success: function (data) {
                document.getElementById('quotation_status_id').value = data.quotation_status_id;
                document.getElementById('quotation_status_name').value = data.quotation_status_name;
                document.getElementById('quotation_status_notes').value = data.quotation_status_notes;
            },
            error: function (error) {
                console.error(error);
            }
        });
    }

    function updateInput(id) {
        let postdata = new FormData();
        postdata.append('_token', document.getElementsByName('_token')[0].defaultValue);
        postdata.append('quotation_status_name', document.getElementById('quotation_status_name').value);
        postdata.append('quotation_status_notes', document.getElementById('quotation_status_notes').value);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            type: "POST",
            url: `/admin/quotation_statuses/${id}`,
            data: postdata,
            processData: false,
            contentType: false,
            dataType: "json",
            async: false,
            success: function (data) {
                if (data.status === 401) {
                    alert('Form fields are required.');
                } else if (data.status === 501) {
                    alert(data.message);
                } else {
                    alert('Updated successfully.');
                    setTimeout(() => {
                        window.open("/admin/quotation_statuses", "_self");
                    }, 500);
                }
            },
            error: function (error) {
                console.error(error);
            }
        });
    }

    function deleteData(id) {
        // if (!confirm('Are you sure you want to delete this item?')) return;

        let postdata = {};
        postdata._token = document.getElementsByName('_token')[0].defaultValue;

        $.ajax({
            type: "DELETE",
            url: `/admin/quotation_statuses/${id}`,
            data: postdata,
            dataType: "json",
            async: false,
            success: function (data) {
                if (data.status === 401) {
                    alert('Form fields are required.');
                } else {
                    alert('Deleted successfully.');
                    setTimeout(() => {
                        window.location.reload();
                    }, 500);
                }
            },
            error: function (error) {
                console.error(error);
            }
        });
    }
</script>
@endsection
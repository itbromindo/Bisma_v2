@extends('backend.layouts.master')

@section('title')
Parameter Duedates - Admin Panel
@endsection

@section('admin-content')
<div class="content-wrapper">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 rt-mb-25">
                    <div class="breadcrumbs">
                        <div class="breadcrumb-title">Account Setting</div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href='/admin'>Home</a></li>
                                <li class="breadcrumb-item"><a href='/admin'>Setting</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Parameter Duedate</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row">
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
                                                    <th scope="col">NAME</th>
                                                    <th scope="col">NOTE</th>
                                                    <th scope="col">Time</th>
                                                    <th scope="col">User CODE</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($parameter_duedates as $parameter_duedate)
                                                    <tr>
                                                        <td scope="row">{{ $loop->index+1 }}</td>
                                                        <td>{{ $parameter_duedate->param_duedate_name }}</td>
                                                        <td>{{ $parameter_duedate->param_duedate_notes }}</td>
                                                        <td>{{ $parameter_duedate->param_duedate_time }}</td>
                                                        <td>{{ $parameter_duedate->user_code }}</td>
                                                        <td>
                                                            <ul class="action-btn">
                                                                <li>
                                                                    <button onclick="delete_data('{{ $parameter_duedate->param_duedate_id }}')">
                                                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M12.5 3.5L3.5 12.5" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                            <path d="M12.5 12.5L3.5 3.5" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                        </svg>
                                                                    </button>
                                                                </li>
                                                                <li>
                                                                    <button title="Edit" onclick="showedit('{{ $parameter_duedate->param_duedate_id }}')">
                                                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M12.1464 1.85355C12.3417 1.65829 12.6583 1.65829 12.8536 1.85355L14.1464 3.14645C14.3417 3.34171 14.3417 3.65829 14.1464 3.85355L5.35355 12.6464L2.5 13.5L3.35355 10.6464L12.1464 1.85355Z" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                            <path d="M11.5 2.5L13.5 4.5" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                        </svg>
                                                                    </button>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
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
                                <input type="hidden" id="param_duedate_id">
                                <div class="fromGroup mb-3">
                                    <label>Nama</label>
                                    <input class="form-control" type="text" id="param_duedate_name" placeholder="Nama Parameter Duedate" />
                                </div>
                                <div class="fromGroup mb-3">
                                    <label>Note</label>
                                    <input class="form-control" type="text" id="param_duedate_notes" placeholder="Catatan" />
                                </div>
                                <div class="fromGroup mb-3">
                                    <label>Time</label>
                                    <textarea class="form-control" name="param_duedate_time" id="param_duedate_time" placeholder="Time"></textarea>
                                </div>
                                <div class="fromGroup mb-3">
                                    <label>User Code</label>
                                    <textarea class="form-control" name="user_code" id="user_code" placeholder="User Code"></textarea>
                                </div>
                                <div class="row">
                                    <button type="button" class="btn btn-primary pill mt-3" onclick="save()">
                                        Save
                                    </button>
                                    <button type="button" class="btn btn-secondary2 pill btn-icon" onclick="reload()">
                                        <span class="button-content-wrapper">
                                            <span class="button-text">
                                                New Data
                                            </span>
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
            </div>
        </div>
    </div>
</div>
<script>
    function reload() {
        window.open("/admin/parameter_duedates", "_self");
    }

    function save() {
        const id = document.getElementById('param_duedate_id').value;
        if (id === '') {
            saveInput();
        } else {
            updateInput(id);
        }
    }

    function saveInput() {
        const postdata = new FormData();
        postdata.append('_token', document.getElementsByName('_token')[0].defaultValue);
        postdata.append('param_duedate_name', document.getElementById('param_duedate_name').value); 
        postdata.append('param_duedate_notes', document.getElementById('param_duedate_notes').value);
        postdata.append('user_code', document.getElementById('user_code').value);
        postdata.append('param_duedate_time', document.getElementById('param_duedate_time').value);


        $.ajax({
            type: "POST",
            url: "/admin/parameter_duedates",
            data: postdata,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function (data) {
                if (data.status === 401) {
                    alert('Form Wajib Harus diisi');
                } else if (data.status === 501) {
                    alert(data.message);
                } else {
                    alert('Berhasil Disimpan');
                    setTimeout(function () {
                        reload();
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
            url: "/admin/parameter_duedates/"+id,
            dataType: "json",
            async: false,
            success: function (data) {
                document.getElementById('param_duedate_id').value = data.param_duedate_id; 
                document.getElementById('param_duedate_name').value = data.param_duedate_name; 
                document.getElementById('param_duedate_notes').value = data.param_duedate_notes;
                document.getElementById('param_duedate_time').value = data.param_duedate_time;
            },
            error: function (dataerror) {
                console.log(dataerror);
            }
        });
    }

    function updateInput(id) {
        var postdata = new FormData();
        postdata.append('_token', document.getElementsByName('_token')[0].defaultValue);
        postdata.append('param_duedate_name', document.getElementById('param_duedate_name').value); 
        postdata.append('param_duedate_notes', document.getElementById('param_duedate_notes').value);
        postdata.append('user_code', document.getElementById('user_code').value);
        postdata.append('param_duedate_time', document.getElementById('param_duedate_time').value);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            type: "POST",
            url: `/admin/parameter_duedates/${id}`,
            data: postdata,
            processData: false,
            contentType: false,
            dataType: "json",
            async: false,
            success: function (data) {
                if (data.status === 401) {
                    alert('Form Wajib Harus diisi');
                    return;
                } else if (data.status === 501) {
                    alert(data.message);
                } else {
                    alert('Berhasil Diupdate');
                    setTimeout(function () {
                        reload();
                    }, 500);
                }
            },
            error: function (dataerror) {
                console.log(dataerror);
            }
        });
    }

    function delete_data(id) {
        const postdata = { _token: document.getElementsByName('_token')[0].defaultValue };

        $.ajax({
            type: "DELETE",
            url: `/admin/parameter_duedates/${id}`,
            data: postdata,
            dataType: "json",
            success: function (data) {
                if (data.status === 401) {
                    alert('Form Wajib Harus diisi');
                } else if (data.status === 501) {
                    alert(data.message);
                } else {
                    alert('Data Berhasil Dihapus');
                    setTimeout(function () {
                        reload();
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

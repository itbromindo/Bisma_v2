@extends('backend.layouts.master')

@section('title')
Master Approvals - Admin Panel
@endsection

@section('admin-content')
<div class="content-wrapper">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 rt-mb-25">
                    <div class="breadcrumbs">
                        <div class="breadcrumb-title">Master Approval Management</div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href='/admin'>Home</a></li>
                                <li class="breadcrumb-item"><a href='/admin'>Setting</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Master Approvals</li>
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
                                                    <th scope="col">APPROVAL NAME</th>
                                                    <th scope="col">DEPARTMENT CODE</th>
                                                    <th scope="col">DIVISION CODE</th>
                                                    <th scope="col">LEVEL CODE</th>
                                                    <th scope="col">NOTE</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($masterApprovals as $approval)
                                                    <tr>
                                                        <td scope="row">{{ $loop->index + 1 }}</td>
                                                        <td>{{ $approval->master_approvals_approval_name }}</td>
                                                        <td>{{ $approval->department_code }}</td>
                                                        <td>{{ $approval->division_code }}</td>
                                                        <td>{{ $approval->level_code }}</td>
                                                        <td>{{ $approval->master_approvals_notes }}</td>
                                                        <td>
                                                            <ul class="action-btn">
                                                                <li>
                                                                    <button onclick="delete_data('{{ $approval->master_approvals_id }}')">
                                                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M12.5 3.5L3.5 12.5" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                            <path d="M12.5 12.5L3.5 3.5" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                        </svg>
                                                                    </button>
                                                                </li>
                                                                <li>
                                                                    <button title="Edit" onclick="showedit('{{ $approval->master_approvals_id }}')">
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
                                <input type="hidden" id="master_approvals_id">
                                <div class="fromGroup mb-3">
                                    <label>Approval Name</label>
                                    <input class="form-control" type="text" id="master_approvals_approval_name" placeholder="Approval Name" />
                                </div>
                                <select class="form-control mb-3" id="department_code">
                                    <option value="">Select Department Code</option>
                                    @if($department_code)
                                        @foreach ($department_code as $department)
                                            <option value="{{ $department->department_code }}">{{ $department->department_code }}</option>
                                        @endforeach
                                    @else
                                        <option value="" disabled>No Department Codes Available</option>
                                    @endif
                                </select>
                                <select class="form-control mb-3" id="division_code">
                                    <option value="">Select divison Code</option>
                                    @if($division_code)
                                        @foreach ($division_code as $division)
                                            <option value="{{ $division->division_code }}">{{ $division->division_code }}</option>
                                        @endforeach
                                    @else
                                        <option value="" disabled>No divison Codes Available</option>
                                    @endif
                                </select>
                                <select class="form-control mb-3" id="level_code">
                                    <option value="">Select level Code</option>
                                    @if($level_code)
                                        @foreach ($level_code as $level)
                                            <option value="{{ $level->level_code }}">{{ $level->level_code }}</option>
                                        @endforeach
                                    @else
                                        <option value="" disabled>No level Codes Available</option>
                                    @endif
                                </select>
                                <div class="fromGroup mb-3">
                                    <label>Note</label>
                                    <textarea class="form-control" name="master_approvals_notes" id="master_approvals_notes" placeholder="Notes"></textarea>
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
    function reload(){
        window.open("/admin/master_approvals", "_self");
    }

    function save() {
        id = document.getElementById('master_approvals_id').value;
        if (id == '') {
            saveInput();
        } else {
            updateInput(id);
        }
    }

    function saveInput() {
        var postdata = new FormData();
        postdata.append('_token', document.getElementsByName('_token')[0].defaultValue);
        postdata.append('master_approvals_approval_name', document.getElementById('master_approvals_approval_name').value); 
        postdata.append('department_code', document.getElementById('department_code').value); 
        postdata.append('division_code', document.getElementById('division_code').value);
        postdata.append('level_code', document.getElementById('level_code').value);
        postdata.append('master_approvals_notes', document.getElementById('master_approvals_notes').value); 

        $.ajax({
            type: "POST",
            url: "/admin/master_approvals",
            data: (postdata),
            processData: false,
            contentType: false,
            dataType: "json",
            async: false,
            success: function (data) {
                if (data.status == 401) {
                    alert('Form Wajib Harus diisi');
                    return;
                } else if (data.status == 501) {
                    alert(data.message);
                    return;
                } else {
                    alert('Berhasil Disimpan');
                    setTimeout(function () {
                        window.open("/admin/master_approvals", "_self");
                    }, 500);
                }
            },
            error: function (dataerror) {
                console.log(dataerror);
            }
        });
    }

    function showedit(id){
        $.ajax({
            type: "GET",
            url: "/admin/master_approvals/"+id,
            dataType: "json",
            async: false,
            success: function (data) {
                document.getElementById('master_approvals_id').value = data.master_approvals_id;
                document.getElementById('master_approvals_approval_name').value = data.master_approvals_approval_name; 
                document.getElementById('department_code').value = data.department_code; 
                document.getElementById('division_code').value = data.division_code;
                document.getElementById('level_code').value = data.level_code;
                document.getElementById('master_approvals_notes').value = data.master_approvals_notes;
            },
            error: function (dataerror) {
                console.log(dataerror);
            }
        });
    }

    function updateInput(id) {
        var postdata = new FormData();
        postdata.append('_token', document.getElementsByName('_token')[0].defaultValue);
        postdata.append('master_approvals_approval_name', document.getElementById('master_approvals_approval_name').value); 
        postdata.append('department_code', document.getElementById('department_code').value); 
        postdata.append('division_code', document.getElementById('division_code').value);
        postdata.append('level_code', document.getElementById('level_code').value);
        postdata.append('master_approvals_notes', document.getElementById('master_approvals_notes').value); 

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            type: "POST",
            url: "/admin/master_approvals/"+id,
            data: (postdata),
            processData: false,
            contentType: false,
            dataType: "json",
            async: false,
            success: function (data) {
                if (data.status == 401) {
                    alert('Form Wajib Harus diisi');
                    return;
                } else if (data.status == 501) {
                    alert(data.message);
                    return;
                } else {
                    alert('Berhasil Update');
                    setTimeout(function () {
                        window.open("/admin/master_approvals", "_self");
                    }, 500);
                }
            },
            error: function (dataerror) {
                console.log(dataerror);
            }
        });
    }

    function delete_data(id){
        var postdata = {};
        postdata._token = document.getElementsByName('_token')[0].defaultValue;
        
        $.ajax({
            type: "DELETE",
            url: "/admin/master_approvals/"+id,
            data: (postdata),
            dataType: "json",
            async: false,
            success: function (data) {
                if (data.status == 401) {
                    alert('Form Wajib Harus diisi');
                    return;
                } else if (data.status == 501) {
                    alert(data.message);
                    return;
                } else {
                    alert('Data Berhasil Dihapus');
                    setTimeout(function () {
                        window.open("/admin/master_approvals", "_self");
                    }, 500);
                }
            },
            error: function (dataerror) {
                console.log(dataerror);
            }
        });
    }
</script>
@endsection

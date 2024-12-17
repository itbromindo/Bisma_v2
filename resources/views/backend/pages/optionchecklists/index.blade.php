@extends('backend.layouts.master')

@section('title')
Option Checklist - Admin Panel
@endsection

@section('admin-content')
<div class="content-wrapper">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 rt-mb-25">
                    <div class="breadcrumbs">
                        <div class="breadcrumb-title">Option Checklist</div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href='/admin'>Home</a></li>
                                <li class="breadcrumb-item"><a href='/admin'>Setting</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Option Checklist</li>
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
                                                    <th scope="col">Checklist Code</th>
                                                    <th scope="col">Items</th>
                                                    <th scope="col">Notes</th>
                                                    <th scope="col">Option Code</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($option_checklist as $item)
                                                    <tr>
                                                        <td scope="row">{{ $loop->index + 1 }}</td>
                                                        <td>{{ $item->checklist_code }}</td>
                                                        <td>{{ $item->option_checklist_items }}</td>
                                                        <td>{{ $item->option_checklist_notes }}</td>
                                                        <td>{{ $item->option_checklist_code }}</td>
                                                        <td>
                                                            <ul class="action-btn">
                                                                <li>
                                                                    <button onclick="delete_data('{{ $item->option_checklist_id }}')">
                                                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M12.5 3.5L3.5 12.5" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                            <path d="M12.5 12.5L3.5 3.5" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                        </svg>
                                                                    </button>
                                                                </li>
                                                                <li>
                                                                    <button title="Edit" onclick="showedit('{{ $item->option_checklist_id }}')">
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
                                <input type="hidden" id="option_checklist_id">
                                <div class="form-group mb-3">
                                    <label for="checklist_code">Checklist Code</label>
                                    <input class="form-control" type="text" id="checklist_code" placeholder="Enter checklist code" />
                                </div>
                                <div class="form-group mb-3">
                                    <label for="option_checklist_items">Items</label>
                                    <input class="form-control" type="text" id="option_checklist_items" placeholder="Enter checklist items" />
                                </div>
                                <div class="form-group mb-3">
                                    <label for="option_checklist_notes">Notes</label>
                                    <textarea class="form-control" id="option_checklist_notes" placeholder="Enter notes"></textarea>
                                </div>
                                <div class="row">
                                    <button type="button" class="btn btn-primary pill mt-3" onclick="save()">
                                        Save
                                    </button>
                                    <button type="button" class="btn btn-secondary pill btn-icon" onclick="reload()">
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
            </div>
        </div>
    </div>
</div>

<script>
    function reload(){
        window.open("/admin/optionchecklists", "_self");
    }

    function save() {
        var id = document.getElementById('option_checklist_id').value;
        if (id == '') {
            saveInput();
        } else {
            updateInput(id);
        }
    }

    function saveInput() {
        var postdata = new FormData();
        postdata.append('_token', document.getElementsByName('_token')[0].defaultValue);
        postdata.append('checklist_code', document.getElementById('checklist_code').value);
        postdata.append('option_checklist_items', document.getElementById('option_checklist_items').value);
        postdata.append('option_checklist_notes', document.getElementById('option_checklist_notes').value);

        $.ajax({
            type: "POST",
            url: "/admin/optionchecklists",
            data: postdata,
            processData: false,
            contentType: false,
            dataType: "json",
            async: false,
            success: function(data) {
                if (data.status == 401) {
                    alert('Form must be filled out correctly');
                    return;
                } else {
                    alert('Successfully saved');
                    setTimeout(function() {
                        window.open("/admin/optionchecklists", "_self");
                    }, 500);
                }
            },
            error: function(dataerror) {
                console.log(dataerror);
            }
        });
    }

    function showedit(id) {
        $.ajax({
            type: "GET",
            url: "/admin/optionchecklists/" + id,
            dataType: "json",
            async: false,
            success: function(data) {
                document.getElementById('option_checklist_id').value = data.id;
                document.getElementById('checklist_code').value = data.checklist_code;
                document.getElementById('option_checklist_items').value = data.option_checklist_items;
                document.getElementById('option_checklist_notes').value = data.option_checklist_notes;
            },
            error: function(dataerror) {
                console.log(dataerror);
            }
        });
    }

    function updateInput(id) {
        var postdata = new FormData();
        postdata.append('_token', document.getElementsByName('_token')[0].defaultValue);
        postdata.append('option_checklist_items', document.getElementById('option_checklist_items').value);
        postdata.append('option_checklist_notes', document.getElementById('option_checklist_notes').value);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            type: "POST",
            url: "/admin/optionchecklists/" + id,
            data: postdata,
            processData: false,
            contentType: false,
            dataType: "json",
            async: false,
            success: function(data) {
                if (data.status == 401) {
                    alert('Form must be filled out correctly');
                    return;
                } else {
                    alert('Successfully updated');
                    setTimeout(function() {
                        window.open("/admin/optionchecklists", "_self");
                    }, 500);
                }
            },
            error: function(dataerror) {
                console.log(dataerror);
            }
        });
    }

    function delete_data(id) {
        var postdata = {};
        postdata._token = document.getElementsByName('_token')[0].defaultValue;

        $.ajax({
            type: "DELETE",
            url: "/admin/optionchecklists/" + id,
            data: postdata,
            dataType: "json",
            async: false,
            success: function(data) {
                if (data.status == 401) {
                    alert('Form must be filled out correctly');
                    return;
                } else {
                    alert('Successfully deleted');
                    setTimeout(function() {
                        window.open("/admin/optionchecklists", "_self");
                    }, 500);
                }
            },
            error: function(dataerror) {
                console.log(dataerror);
            }
        });
    }
</script>
@endsection

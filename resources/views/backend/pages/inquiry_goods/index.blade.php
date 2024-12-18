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
                        <div class="breadcrumb-title"> Inquiry Goods</div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href='/admin'>Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Inquiry Goods</li>
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
                                                    <th scope="col">CODE</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($inquiry_goods as $inquiry_good)
                                                    <tr>
                                                        <td scope="row">{{ $loop->index + 1 }}</td>
                                                        <td>{{ $inquiry_good->inquiry_goods_status_name }}</td>
                                                        <td>{{ $inquiry_good->inquiry_goods_status_notes }}</td>
                                                        <td>{{ $inquiry_good->inquiry_goods_status_code }}</td>
                                                        <td>
                                                            <ul class="action-btn">
                                                                <li>
                                                                    <button onclick="delete_data('{{ $inquiry_good->inquiry_goods_status_id }}')">
                                                                        <svg width="16" height="16" fill="none">
                                                                            <path d="M12.5 3.5L3.5 12.5" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                            <path d="M12.5 12.5L3.5 3.5" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                        </svg>
                                                                    </button>
                                                                </li>
                                                                <li>
                                                                    <button title="Edit" onclick="showedit('{{ $inquiry_good->inquiry_goods_status_id }}')">
                                                                        <svg width="16" height="16" fill="none">
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
                                <input type="hidden" id="inquiry_good_id">
                                <div class="fromGroup mb-3">
                                    <label>Name</label>
                                    <input class="form-control" type="text" id="inquiry_goods_status_name" placeholder="Inquiry Goods Name" />
                                </div>
                                <div class="fromGroup mb-3">
                                    <label>Note</label>
                                    <textarea class="form-control" id="inquiry_goods_status_notes" placeholder="Notes"></textarea>
                                </div>
                                <div class="row">
                                    <button type="button" class="btn btn-primary mt-3" onclick="save()">
                                        Save
                                    </button>
                                    <button type="button" class="btn btn-secondary2 btn-icon" onclick="reload()">
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
        window.open("/admin/inquiry_goods", "_self");
    }

    function save() {
        let id = document.getElementById('inquiry_good_id').value;
        if (id === '') {
            saveInput();
        } else {
            updateInput(id);
        }
    }

    function saveInput() {
        let postdata = new FormData();
        postdata.append('_token', document.getElementsByName('_token')[0].defaultValue);
        postdata.append('inquiry_goods_status_name', document.getElementById('inquiry_goods_status_name').value);
        postdata.append('inquiry_goods_status_notes', document.getElementById('inquiry_goods_status_notes').value);

        $.ajax({
            type: "POST",
            url: "/admin/inquiry_goods",
            data: postdata,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function(data) {
                if (data.status === 401) {
                    alert('Form is required');
                    return;
                } else {
                    alert('Successfully saved');
                    setTimeout(() => window.open("/admin/inquiry_goods", "_self"), 500);
                }
            },
            error: function(error) {
                console.error(error);
            }
        });
    }

    function showedit(id) {
        $.ajax({
            type: "GET",
            url: "/admin/inquiry_goods/" + id,
            dataType: "json",
            success: function(data) {
                document.getElementById('inquiry_good_id').value = data.inquiry_goods_status_id;
                document.getElementById('inquiry_goods_status_name').value = data.inquiry_goods_status_name;
                document.getElementById('inquiry_goods_status_notes').value = data.inquiry_goods_status_notes;
            },
            error: function(error) {
                console.error(error);
            }
        });
    }

    function updateInput(id) {
        let postdata = new FormData();
        postdata.append('_token', document.getElementsByName('_token')[0].defaultValue);
        postdata.append('inquiry_goods_status_name', document.getElementById('inquiry_goods_status_name').value);
        postdata.append('inquiry_goods_status_notes', document.getElementById('inquiry_goods_status_notes').value);

        $.ajax({
            type: "POST",
            url: "/admin/inquiry_goods/" + id,
            data: postdata,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function(data) {
                if (data.status === 401) {
                    alert('Form is required');
                    return;
                } else {
                    alert('Successfully updated');
                    setTimeout(() => window.open("/admin/inquiry_goods", "_self"), 500);
                }
            },
            error: function(error) {
                console.error(error);
            }
        });
    }

    function delete_data(id) {
        let postdata = {
            _token: document.getElementsByName('_token')[0].defaultValue
        };

        $.ajax({
            type: "DELETE",
            url: "/admin/inquiry_goods/" + id,
            data: postdata,
            dataType: "json",
            success: function(data) {
                if (data.status === 401) {
                    alert('Form is required');
                    return;
                } else {
                    alert('Successfully deleted');
                    setTimeout(() => window.open("/admin/inquiry_goods", "_self"), 500);
                }
            },
            error: function(error) {
                console.error(error);
            }
        });
    }
</script>
@endsection

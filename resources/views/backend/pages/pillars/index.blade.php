@extends('backend.layouts.master')

@section('title')
Pillars - Admin Panel
@endsection

@section('admin-content')
<div class="content-wrapper">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 rt-mb-25">
                    <div class="breadcrumbs">
                        <div class="breadcrumb-title"> Account Setting</div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href='/admin'>Home</a></li>
                                <li class="breadcrumb-item"><a href='/admin'>Setting</a></li>
                                <li class="breadcrumb-item active" aria-current="page"> Pillars</li>
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
                                                @foreach ($pillars as $pillar)
                                                    <tr>
                                                        <td scope="row">{{ $loop->index + 1 }}</td>
                                                        <td>{{ $pillar->pillar_items }}</td>
                                                        <td>{{ $pillar->pillar_notes }}</td>
                                                        <td>{{ $pillar->pillar_code }}</td>
                                                        <td>
                                                            <ul class="action-btn">
                                                                <li>
                                                                    <button onclick="delete_data('{{ $pillar->pillar_id }}')">
                                                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M12.5 3.5L3.5 12.5" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                            <path d="M12.5 12.5L3.5 3.5" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                        </svg>
                                                                    </button>
                                                                </li>
                                                                <li>
                                                                    <button title="Edit" onclick="showedit('{{ $pillar->pillar_id }}')">
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
                                <input type="hidden" id="pillar_id">
                                <!-- <div class="fromGroup mb-3">
                                    <label>Menu</label>
                                    <select class="form-control" id="menus_code" style="width: 100%;">
                                        <option value="" disabled selected>Pilih Modul</option>
                                    </select>
                                </div> -->
                                <div class="fromGroup mb-3">
                                    <label>Nama</label>
                                    <input class="form-control" type="text" id="pillar_items" placeholder="Nama Pilar" />
                                </div>
                                <div class="fromGroup mb-3">
                                    <label>Note</label>
                                    <textarea class="form-control" name="pillar_notes" id="pillar_notes" placeholder="Catatan"></textarea>
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
    $(document).ready(function() {
        $('#menus_code').select2({
            placeholder: "Pilih Modul",
            allowClear: true,
            ajax: {
                url: '/admin/combomenu',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        search: params.term
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });
    });

    function reload(){
        window.open("/admin/pillars", "_self");
    }

    function save() {
        id = document.getElementById('pillar_id').value;
        if (id == '') {
            saveInput();
        } else {
            updateInput(id);
        }
    }

    function saveInput() {
        var postdata = new FormData();
        postdata.append('_token', document.getElementsByName('_token')[0].defaultValue);
        // postdata.append('menus_code', document.getElementById('menus_code').value); 
        postdata.append('pillar_items', document.getElementById('pillar_items').value); 
        postdata.append('pillar_notes', document.getElementById('pillar_notes').value); 

        $.ajax({
            type: "POST",
            url: "/admin/pillars",
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
                        window.open("/admin/pillars", "_self");
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
            url: "/admin/pillars/"+id,
            dataType: "json",
            async: false,
            success: function (data) {
                document.getElementById('pillar_id').value = data.pillar_id;
                document.getElementById('pillar_items').value = data.pillar_items; 
                document.getElementById('pillar_notes').value = data.pillar_notes;

                $('#menus_code').append(new Option(data.menus_name, data.menus_code, true, true)).trigger('change');
            },
            error: function (dataerror) {
                console.log(dataerror);
            }
        });
    }

    function updateInput(id) {
        var postdata = new FormData();
        postdata.append('_token', document.getElementsByName('_token')[0].defaultValue);
        // postdata.append('menus_code', document.getElementById('menus_code').value); 
        postdata.append('pillar_items', document.getElementById('pillar_items').value); 
        postdata.append('pillar_notes', document.getElementById('pillar_notes').value); 

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            type: "POST",
            url: "/admin/pillars/"+id,
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
                        window.open("/admin/pillars", "_self");
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
            url: "/admin/pillars/"+id,
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
                        window.open("/admin/pillars", "_self");
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
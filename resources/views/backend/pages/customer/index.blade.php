
@extends('backend.layouts.master')

@section('title')
Customer - Admin Panel
@endsection

@section('admin-content')
<div class="content-wrapper">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 rt-mb-25">
                    <div class="breadcrumbs ">
                        <div class="breadcrumb-title"> Master</div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href='/admin'>Home</a></li>
                                <li class="breadcrumb-item"><a href='/admin'>Master</a></li>
                                <li class="breadcrumb-item active" aria-current="page"> Customer</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 pt-0 px-2 pl-md-0 pr-md-2">
                    <div class="card border-top-primary">

                        <div class="card-body">
                            <ul class="nav nav-tabs nav-tabs-bottom">
                                <li class="nav-item">
                                    <a href="#bottom-tab1" id="tab1" class="nav-link active font-weight-bold text-uppercase font-size-lg"
                                    data-bs-toggle="tab">
                                        
                                        List Customer
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#bottom-tab2" id="tab2" class="nav-link font-weight-bold text-uppercase font-size-lg"
                                    data-bs-toggle="tab">
                                        
                                        Tambah/Edit Customer
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="bottom-tab1">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="col-md-12 pt-0 pl-1 pr-1">
                                                <section class="tables">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="table-wrapper">
                                                                <div class="table-content table-responsive">
                                                                    <table class="table align-middle table-basic ">
                                                                        <thead style="text-align: center">
                                                                            <tr>
                                                                                <th scope="col">NO</th>
                                                                                <th scope="col">NAME</th>
                                                                                <th scope="col">PHONE</th>
                                                                                <th scope="col">ADDRESS</th>
                                                                                <th scope="col">Action</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($customer as $csr)
                                                                                <tr>
                                                                                    <td scope="row">{{ $loop->index+1 }}</td>
                                                                                    <td>{{ $csr->customer_name }}</td>
                                                                                    <td>{{ $csr->customers_phone }}</td>
                                                                                    <td>{{ $csr->customers_full_address }}</td>
                                                                                    <td>
                                                                                        <ul class="action-btn">
                                                                                            <li>
                                                                                                <button onclick="delete_data('{{ $csr->customer_id }}')">
                                                                                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                                        <path d="M12.5 3.5L3.5 12.5" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                                                        <path d="M12.5 12.5L3.5 3.5" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                                                    </svg>
                                                                                                </button>
                                                                                            </li>
                                                                                            <li>
                                                                                                <button title="Edit" onclick="showedit('{{ $csr->customer_id }}')">
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
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="bottom-tab2">
                                    <div class="col-md-12 pt-0 pl-1 pr-1">
                                        <div class="card">
                                            <div class="card-body">
                                                <form>
                                                    <input type="hidden" id="customer_id">
                                                    <div class="row">
                                                        <div class="col-mb-3 col-lg-3">
                                                            <div class="fromGroup mb-3">
                                                                <label>NAMA</label>
                                                                <input class="form-control" type="text" id="customer_name" placeholder="Nama Customer" />
                                                            </div>
                                                        </div>
                                                        <div class="col-mb-3 col-lg-3">
                                                            <div class="fromGroup mb-3">
                                                                <label>EXISTING</label>
                                                                <input class="form-control" type="number" id="customers_existing" placeholder="Harga Existing" />
                                                            </div>
                                                        </div>
                                                        <div class="col-mb-3 col-lg-3">
                                                            <div class="fromGroup mb-3">
                                                                <label>ALAMAT</label>
                                                                <textarea class="form-control" name="customers_full_address" id="customers_full_address" placeholder="Alamat Lengkap"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-mb-3 col-lg-3">
                                                            <div class="fromGroup mb-3">
                                                                <label>NO TLPN</label>
                                                                <input class="form-control" type="number" id="customers_phone" placeholder="No Phone" />
                                                            </div>
                                                        </div>
                                                        <div class="col-mb-3 col-lg-3">
                                                            <div class="fromGroup mb-3">
                                                                <label>EMAIL</label>
                                                                <input class="form-control" type="text" id="customers_email" placeholder="E-mail" />
                                                            </div>
                                                        </div>
                                                        <div class="col-mb-3 col-lg-3">
                                                            <div class="fromGroup mb-3">
                                                                <label>PIC</label>
                                                                <input class="form-control" type="text" id="customers_PIC" placeholder="PIC" />
                                                            </div>
                                                        </div>
                                                        <div class="col-mb-3 col-lg-3">
                                                            <div class="fromGroup mb-3">
                                                                <label>NPWP</label>
                                                                <input class="form-control" type="text" id="customers_npwp" placeholder="No Npwp" />
                                                            </div>
                                                        </div>
                                                        <div class="col-mb-3 col-lg-3">
                                                            <div class="fromGroup mb-3">
                                                                <label>KELURAHAN</label>
                                                                <input class="form-control" type="text" id="customers_village" placeholder="Kelurahan" />
                                                            </div>
                                                        </div>
                                                        <div class="col-mb-3 col-lg-3">
                                                            <div class="fromGroup mb-3">
                                                                <label>KECAMATAN</label>
                                                                <select class="form-control" id="districts_code" style="width: 100%;">
                                                                    <option value="" disabled selected>Pilih Kecamatan</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-mb-3 col-lg-3">
                                                            <div class="fromGroup mb-3">
                                                                <label>KOTA / KABUPATEN</label>
                                                                <select class="form-control" id="cities_code" style="width: 100%;">
                                                                    <option value="" disabled selected>Pilih Kabupaten/Kota</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-mb-3 col-lg-3">
                                                            <div class="fromGroup mb-3">
                                                                <label>PROVINSI</label>
                                                                <select class="form-control" id="provinces_code" style="width: 100%;">
                                                                    <option value="" disabled selected>Pilih Provinsi</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-mb-3 col-lg-3">
                                                            <div class="fromGroup mb-3">
                                                                <label>KATEGORI</label>
                                                                <select class="form-control" id="customers_category" style="width: 100%;">
                                                                    <option value="" disabled selected>Pilih Kategori</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-mb-4 col-lg-4">
                                                            <div class="form-group mb-3">
                                                                <label>AREA</label>
                                                                <div class="row" id="customers_area">
                                                                    <!-- Radio Option 1 -->
                                                                    <div class="col-4">
                                                                        <div class="form-check from-radio-custom mb-3">
                                                                            <input class="form-check-input" type="radio" name="customers_area" id="barat" value="barat">
                                                                            <label class="form-check-label" for="barat">
                                                                                Barat
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <!-- Radio Option 2 -->
                                                                    <div class="col-4">
                                                                        <div class="form-check from-radio-custom mb-3">
                                                                            <input class="form-check-input" type="radio" name="customers_area" id="tengah" value="tengah">
                                                                            <label class="form-check-label" for="tengah">
                                                                                Tengah
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <!-- Radio Option 3 -->
                                                                    <div class="col-4">
                                                                        <div class="form-check from-radio-custom mb-3">
                                                                            <input class="form-check-input" type="radio" name="customers_area" id="timur" value="timur">
                                                                            <label class="form-check-label" for="timur">
                                                                                Timur
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-mb-5 col-lg-5">
                                                            <div class="fromGroup mb-3">
                                                                <label>Catatan</label>
                                                                <textarea class="form-control" name="customers_notes" id="customers_notes" placeholder="Catatan"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12 d-flex justify-content-center align-items-center">
                                                            <button type="button" class="btn btn-secondary btn-sm mx-2" onclick="reload()">
                                                                <span class="button-content-wrapper d-flex align-items-center">
                                                                    <span class="button-text me-1">
                                                                        New Data
                                                                    </span>
                                                                    <span class="button-icon">
                                                                        <i class="ph-arrow-left"></i>
                                                                    </span>
                                                                </span>
                                                            </button>
                                                            <button type="button" class="btn btn-primary btn-sm mx-2" onclick="save()">
                                                                Save
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script>

    $(document).ready(function() {        
        $('#districts_code').select2({
            placeholder: "Pilih Kecamatan",
            allowClear: true,
            ajax: {
                url: '/admin/combodistricts',
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

        $('#cities_code').select2({
            placeholder: "Pilih Kota/Kabupaten",
            allowClear: true,
            ajax: {
                url: '/admin/combocities',
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

        $('#provinces_code').select2({
            placeholder: "Pilih Provinsi",
            allowClear: true,
            ajax: {
                url: '/admin/comboprovinces',
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

        $('#customers_category').select2({
            placeholder: "Pilih Kategori",
            allowClear: true,
            ajax: {
                url: '/admin/combokategoricustomer',
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
        // setTimeout(function () {
            window.open("/admin/customer", "_self");
        // }, 500);
    }

    function save() {
        id = document.getElementById('customer_id').value;
        if (id == '') {
            saveInput();
        } else {
            updateInput(id);
        }
    }

    function saveInput() {
        var postdata = new FormData();
        // Tambahkan token CSRF
        postdata.append('_token', document.getElementsByName('_token')[0].defaultValue);
        postdata.append('customer_name', document.getElementById('customer_name').value); 
        postdata.append('customers_existing', document.getElementById('customers_existing').value); 
        postdata.append('customers_full_address', document.getElementById('customers_full_address').value);
        postdata.append('customers_phone', document.getElementById('customers_phone').value);
        postdata.append('customers_email', document.getElementById('customers_email').value);
        postdata.append('customers_PIC', document.getElementById('customers_PIC').value);
        postdata.append('customers_npwp', document.getElementById('customers_npwp').value);
        postdata.append('customers_village', document.getElementById('customers_village').value);
        postdata.append('districts_code', document.getElementById('districts_code').value);
        postdata.append('cities_code', document.getElementById('cities_code').value);
        postdata.append('provinces_code', document.getElementById('provinces_code').value);
        postdata.append('customers_category', document.getElementById('customers_category').value);
        postdata.append('customers_area', document.querySelector('input[name="customers_area"]:checked').value);
        postdata.append('customers_notes', document.getElementById('customers_notes').value);

        $.ajax({
            type: "POST",
            url: "/admin/customer",
            data: (postdata),
            processData: false, // Jangan ubah data
            contentType: false, // Atur tipe konten secara otomatis
            dataType: "json",
            async: false,
            success: function (data) {
                // console.log('hasil => ',data);
                
                if (data.status == 401) {
                    alert('Form Wajib Harus diisi');
                    return;
                } else if (data.status == 501) {
                    alert(data.message);
                    return;
                } else {
                    alert('Berhasil Disimpan');
                    setTimeout(function () {
                        window.open("/admin/customer", "_self");
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
            url: "/admin/customer/"+id,
            dataType: "json",
            async: false,
            success: function (data) {
                // console.log('hasil => ',data);
                document.getElementById('customer_id').value = data.customer_id; 
                document.getElementById('customer_name').value = data.customer_name; 
                document.getElementById('customers_existing').value = data.customers_existing; 
                document.getElementById('customers_full_address').value = data.customers_full_address;
                document.getElementById('customers_phone').value = data.customers_phone;
                document.getElementById('customers_email').value = data.customers_email;
                document.getElementById('customers_PIC').value = data.customers_PIC;
                document.getElementById('customers_npwp').value = data.customers_npwp;
                document.getElementById('customers_village').value = data.customers_village;
                $('#districts_code').append(new Option(data.districts_name, data.districts_code, true, true)).trigger('change');
                $('#cities_code').append(new Option(data.cities_name, data.cities_code, true, true)).trigger('change');
                $('#provinces_code').append(new Option(data.provinces_name, data.provinces_code, true, true)).trigger('change');
                $('#customers_category').append(new Option(data.customer_category_name, data.customers_category, true, true)).trigger('change');
                document.querySelector(`input[name="customers_area"][id="${data.customers_area}"]`).checked = true
                document.getElementById('customers_notes').value = data.customers_notes;

                $('#tab2').tab('show');
            },
            error: function (dataerror) {
                console.log(dataerror);
            }
        });
    }

    function updateInput(id) {
        var postdata = new FormData();
        // Tambahkan token CSRF
        postdata.append('_token', document.getElementsByName('_token')[0].defaultValue);
        postdata.append('customer_name', document.getElementById('customer_name').value); 
        postdata.append('customers_existing', document.getElementById('customers_existing').value); 
        postdata.append('customers_full_address', document.getElementById('customers_full_address').value);
        postdata.append('customers_phone', document.getElementById('customers_phone').value);
        postdata.append('customers_email', document.getElementById('customers_email').value);
        postdata.append('customers_PIC', document.getElementById('customers_PIC').value);
        postdata.append('customers_npwp', document.getElementById('customers_npwp').value);
        postdata.append('customers_village', document.getElementById('customers_village').value);
        postdata.append('districts_code', document.getElementById('districts_code').value);
        postdata.append('cities_code', document.getElementById('cities_code').value);
        postdata.append('provinces_code', document.getElementById('provinces_code').value);
        postdata.append('customers_category', document.getElementById('customers_category').value);
        postdata.append('customers_area', document.querySelector('input[name="customers_area"]:checked').value);
        postdata.append('customers_notes', document.getElementById('customers_notes').value);
        // console.log('Data FormData: ', Array.from(postdata.entries()));
        

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            type: "POST",
            url: "/admin/customer/"+id,
            data: (postdata),
            processData: false, // Jangan ubah data
            contentType: false, // Atur tipe konten secara otomatis
            dataType: "json",
            async: false,
            success: function (data) {
                // console.log('hasil => ',data);
                
                if (data.status == 401) {
                    alert('Form Wajib Harus diisi');
                    return;
                } else if (data.status == 501) {
                    alert(data.message);
                    return;
                } else {
                    alert('Berhasil Diupdate');
                    setTimeout(function () {
                        window.open("/admin/customer", "_self");
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
            url: "/admin/customer/"+id,
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
                        window.open("/admin/customer", "_self");
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
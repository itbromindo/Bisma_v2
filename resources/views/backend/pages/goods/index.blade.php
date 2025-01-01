
@extends('backend.layouts.master')

@section('title')
Goods - Admin Panel
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
                    <div class="breadcrumbs ">
                        <div class="breadcrumb-title"> Master</div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href='/admin'>Home</a></li>
                                <li class="breadcrumb-item"><a href='/admin'>Master</a></li>
                                <li class="breadcrumb-item active" aria-current="page"> Barang</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 pt-0 px-2 pl-md-0 pr-md-2">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5>Master Barang</h5>
                            <div class="d-flex align-items-center">
                                <div class="app-main-search me-2">
                                    <form action="/admin/goods" method="GET" class="d-flex">
                                        <div class="input-box d-flex">
                                            <input type="text" name="search" id="search" value="{{$search ?? ''}}" class="form-control" placeholder="Search Here">
                                            <button type="submit" class="btn btn-light ms-2">
                                                <img src="{{ asset('backend/assets/images/svg/search.svg')}}" alt="Search" draggable="false">
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                @if ($usr->can('goods.create'))
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalinput" onclick="clearform()">Tambah Data</button>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <section class="tables">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="table-wrapper">
                                            <div class="table-content table-responsive">
                                                <table class="table align-middle table-basic ">
                                                    <thead style="text-align: center">
                                                        <tr>
                                                            <th scope="col" width="5%">NO</th>
                                                            <th scope="col">CODE</th>
                                                            <th scope="col">NAME</th>
                                                            <th scope="col">HARGA</th>
                                                            <th scope="col">NOTE</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($barang as $brg)
                                                            <tr>
                                                                <td scope="row" class="text-center">{{ $loop->index+1 }}</td>
                                                                <td>{{ $brg->goods_code }}</td>
                                                                <td>{{ $brg->goods_name }}</td>
                                                                <td>{{ $brg->goods_price }}</td>
                                                                <td>{{ $brg->goods_notes }}</td>
                                                                <td class="text-center">
                                                                    <div class="d-flex justify-content-center gap-2">
                                                                        <!-- Tombol Delete -->
                                                                        @if ($usr->can('goods.delete'))
                                                                        <button class="btn btn-light btn-sm border border-danger text-danger" title="Delete" onclick="delete_data('{{ $brg->goods_id }}')">
                                                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                <path d="M12.5 3.5L3.5 12.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                                <path d="M12.5 12.5L3.5 3.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                            </svg>
                                                                        </button>
                                                                        @endif
                                                                        <!-- Tombol Edit -->
                                                                        <button class="btn btn-light btn-sm border border-success text-success" title="Edit" onclick="showedit('{{ $brg->goods_id }}')">
                                                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
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
                                <!-- Pagination -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <nav aria-label="Page navigation">
                                            <ul class="pagination justify-content-end">
                                                <!-- Previous Page Link -->
                                                <li class="page-item {{ $barang->onFirstPage() ? 'disabled' : '' }}">
                                                    <a class="page-link" href="{{ $barang->appends(['search' => $search ?? request('search')])->previousPageUrl() }}" aria-label="Previous">
                                                        <i class="ph-arrow-left"></i>
                                                    </a>
                                                </li>

                                                <!-- Page Number Links -->
                                                @foreach ($barang->onEachSide(0)->appends(['search' => $search ?? request('search')])->links()->elements[0] as $page => $url)
                                                    <li class="page-item {{ $barang->currentPage() == $page ? 'active' : '' }}">
                                                        <a class="page-link" href="{{ $url }}">{{ sprintf('%02d', $page) }}</a>
                                                    </li>
                                                @endforeach

                                                <!-- Next Page Link -->
                                                <li class="page-item {{ $barang->hasMorePages() ? '' : 'disabled' }}">
                                                    <a class="page-link" href="{{ $barang->appends(['search' => $search ?? request('search')])->nextPageUrl() }}" aria-label="Next">
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
<div class="modal fade" id="modalinput" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 85%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tittleform">Form Input</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" id="goods_id">
                    <div id="alert-container"></div> <!-- Tempat Alert -->
                    <div class="row">
                        <div class="col-mb-3 col-lg-3">
                            <div class="fromGroup mb-3">
                                <label>Nama</label>
                                <input class="form-control" type="text" id="goods_name" placeholder="Nama Produk" />
                            </div>
                        </div>
                        <div class="col-mb-3 col-lg-3">
                            <div class="fromGroup mb-3">
                                <label>FOTO</label>
                                <input class="form-control" type="file" id="goods_photo" placeholder="Foto Produk" />
                            </div>
                        </div>
                        <div class="col-mb-3 col-lg-3">
                            <div class="form-group mb-3">
                                <label>PERUNTUKAN</label>
                                <div class="row" id="goods_usage">
                                    <!-- Radio Option 1 -->
                                    <div class="col-6">
                                        <div class="form-check from-radio-custom mb-3">
                                            <input class="form-check-input" type="radio" name="goods_usage" id="inventory_office" value="inventory_office">
                                            <label class="form-check-label" for="inventory_office">
                                                Inventory Kantor
                                            </label>
                                        </div>
                                    </div>
                                    <!-- Radio Option 2 -->
                                    <div class="col-6">
                                        <div class="form-check from-radio-custom mb-3">
                                            <input class="form-check-input" type="radio" name="goods_usage" id="warehouse" value="warehouse">
                                            <label class="form-check-label" for="warehouse">
                                                Gudang
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-mb-3 col-lg-3">
                            <div class="fromGroup mb-3">
                                <label>SPESIFIKASI</label>
                                <div class="row" id="goods_specification">
                                    <!-- Radio Option 1 -->
                                    <div class="col-6">
                                        <div class="form-check from-radio-custom mb-3">
                                            <input class="form-check-input" type="radio" name="goods_specification" id="umum" value="umum">
                                            <label class="form-check-label" for="umum">
                                                Umum
                                            </label>
                                        </div>
                                    </div>
                                    <!-- Radio Option 2 -->
                                    <div class="col-6">
                                        <div class="form-check from-radio-custom mb-3">
                                            <input class="form-check-input" type="radio" name="goods_specification" id="spesial" value="spesial">
                                            <label class="form-check-label" for="spesial">
                                                Spesial
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-mb-3 col-lg-3">
                            <div class="fromGroup mb-3">
                                <label>BRAND</label>
                                <select class="form-control" id="brand_code" style="width: 100%;">
                                    <option value="" disabled selected>Pilih Brand</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-mb-3 col-lg-3">
                            <div class="fromGroup mb-3">
                                <label>HARGA POKOK</label>
                                <input class="form-control" type="number" id="goods_price" placeholder="Harga Pokok" />
                            </div>
                        </div>
                        <div class="col-mb-3 col-lg-3">
                            <div class="fromGroup mb-3">
                                <label>STOK BARANG</label>
                                <input class="form-control" type="number" id="goods_stock" placeholder="Stok Barang" />
                            </div>
                        </div>
                        <div class="col-mb-3 col-lg-3">
                            <div class="fromGroup mb-3">
                                <label>MARGIN END USER (%)</label>
                                <input class="form-control" type="number" id="goods_end_user_margin" placeholder="Margin (%)" />
                            </div>
                        </div>
                        <div class="col-mb-3 col-lg-3">
                            <div class="fromGroup mb-3">
                                <label>MARGIN KONTRAKTOR (%)</label>
                                <input class="form-control" type="number" id="goods_contractor_margin" placeholder="Margin (%)" />
                            </div>
                        </div>
                        <div class="col-mb-3 col-lg-3">
                            <div class="fromGroup mb-3">
                                <label>MARGIN RESELLER (%)</label>
                                <input class="form-control" type="number" id="goods_reseller_margin" placeholder="Margin (%)" />
                            </div>
                        </div>
                        <div class="col-mb-3 col-lg-3">
                            <div class="fromGroup mb-3">
                                <label>MARGIN PRICE LIST (%)</label>
                                <input class="form-control" type="number" id="goods_pricelist_margon" placeholder="Margin (%)" />
                            </div>
                        </div>
                        <div class="col-mb-3 col-lg-3">
                            <div class="fromGroup mb-3">
                                <label>HARGA END USER</label>
                                <input class="form-control" type="number" id="goods_end_user_price" placeholder="Harga" />
                            </div>
                        </div>
                        <div class="col-mb-3 col-lg-3">
                            <div class="fromGroup mb-3">
                                <label>HARGA KONTRAKTOR</label>
                                <input class="form-control" type="number" id="goods_contractor_price" placeholder="Harga" />
                            </div>
                        </div>
                        <div class="col-mb-3 col-lg-3">
                            <div class="fromGroup mb-3">
                                <label>HARGA RESELLER</label>
                                <input class="form-control" type="number" id="goods_reseller_price" placeholder="Harga" />
                            </div>
                        </div>
                        <div class="col-mb-3 col-lg-3">
                            <div class="fromGroup mb-3">
                                <label>HARGA PRICE LIST</label>
                                <input class="form-control" type="number" id="goods_pricelist_price" placeholder="Harga" />
                            </div>
                        </div>
                        <div class="col-mb-3 col-lg-3">
                            <div class="fromGroup mb-3">
                                <label>SATUAN</label>
                                <select class="form-control" id="uom_code" style="width: 100%;">
                                    <option value="" disabled selected>Pilih Satuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-mb-3 col-lg-3">
                            <div class="fromGroup mb-3">
                                <label>BERAT</label>
                                <input class="form-control" type="number" id="goods_weight" placeholder="Berat" />
                            </div>
                        </div>
                        <div class="col-mb-3 col-lg-3">
                            <div class="fromGroup mb-3">
                                <label>TYPE</label>
                                <select class="form-control" id="product_division_code" style="width: 100%;">
                                    <option value="" disabled selected>Pilih Type</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-mb-3 col-lg-3">
                            <div class="fromGroup mb-3">
                                <label>KATEGORI</label>
                                <select class="form-control" id="product_category_code" style="width: 100%;">
                                    <option value="" disabled selected>Pilih Kategori</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-mb-3 col-lg-3">
                            <div class="fromGroup mb-3">
                                <label>KETERSEDIAAN</label>
                                <div class="row" id="goods_availability">
                                    <!-- Radio Option 1 -->
                                    <div class="col-6">
                                        <div class="form-check from-radio-custom mb-3">
                                            <input class="form-check-input" type="radio" name="goods_availability" id="ready" value="ready">
                                            <label class="form-check-label" for="ready">
                                                Ready
                                            </label>
                                        </div>
                                    </div>
                                    <!-- Radio Option 2 -->
                                    <div class="col-6">
                                        <div class="form-check from-radio-custom mb-3">
                                            <input class="form-check-input" type="radio" name="goods_availability" id="indent" value="indent">
                                            <label class="form-check-label" for="indent">
                                                Indent
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-mb-3 col-lg-3">
                            <div class="fromGroup mb-3">
                                <label>Catatan</label>
                                <textarea class="form-control" name="goods_notes" id="goods_notes" placeholder="Catatan"></textarea>
                            </div>
                        </div>
                        <!-- <div class="fromGroup mb-3">
                            <label>Note</label>
                        </div> -->
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                @if ($usr->can('goods.create'))
                <button type="button" class="btn btn-warning" onclick="clearform()">Clear Data</button>
                @endif
                @if ($usr->can('goods.update') || $usr->can('goods.create'))
                <button type="button" class="btn btn-primary" id="saveclick" onclick="save()">Save</button>
                @endif
            </div>
        </div>
    </div>
</div>
<script>

    $(document).ready(function() {        
        $('#brand_code').select2({
            placeholder: "Pilih Brand",
            allowClear: true,
            ajax: {
                url: '/admin/combobrand',
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

        $('#uom_code').select2({
            placeholder: "Pilih Satuan",
            allowClear: true,
            ajax: {
                url: '/admin/combosatuan',
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

        $('#product_division_code').select2({
            placeholder: "Pilih Type",
            allowClear: true,
            ajax: {
                url: '/admin/comboproductdivision',
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

        $('#product_category_code').select2({
            placeholder: "Pilih Kategori",
            allowClear: true,
            ajax: {
                url: '/admin/combokategori',
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
            window.open("/admin/goods", "_self");
        // }, 500);
    }

    function save() {
        id = document.getElementById('goods_id').value;
        if (id == '') {
            saveInput();
        } else {
            updateInput(id);
        }
    }

    function clearform() {
        document.getElementById('goods_id').value = '';
        document.getElementById('goods_name').value = ''; 
        document.getElementById('goods_photo').value = ''; 
        document.querySelectorAll('input[name="goods_usage"]').forEach(radio => radio.checked = false);
        document.querySelectorAll('input[name="goods_specification"]').forEach(radio => radio.checked = false);
        $('#brand_code').append(new Option('', '', true, true)).trigger('change');
        document.getElementById('goods_price').value = '';
        document.getElementById('goods_stock').value = '';
        document.getElementById('goods_end_user_margin').value = '';
        document.getElementById('goods_contractor_margin').value = '';
        document.getElementById('goods_reseller_margin').value = '';
        document.getElementById('goods_pricelist_margon').value = '';
        document.getElementById('goods_end_user_price').value = '';
        document.getElementById('goods_contractor_price').value = '';
        document.getElementById('goods_reseller_price').value = '';
        document.getElementById('goods_pricelist_price').value = '';
        $('#uom_code').append(new Option('', '', true, true)).trigger('change');
        document.getElementById('goods_weight').value = '';
        $('#product_division_code').append(new Option('', '', true, true)).trigger('change');
        $('#product_category_code').append(new Option('', '', true, true)).trigger('change');
        document.querySelectorAll('input[name="goods_availability"]').forEach(radio => radio.checked = false);
        document.getElementById('goods_notes').value = '';

        document.getElementById('tittleform').innerHTML = 'Form Input';
        document.getElementById('saveclick').innerHTML = 'Save';
    }

    function saveInput() {
        var postdata = new FormData();
        // Tambahkan token CSRF
        postdata.append('_token', document.getElementsByName('_token')[0].defaultValue);
        postdata.append('goods_name', document.getElementById('goods_name').value); 
        postdata.append('goods_photo', document.getElementById('goods_photo').files[0]);

        // Handle radio button dengan pengecekan null
        postdata.append('goods_usage', document.querySelector('input[name="goods_usage"]:checked') ? document.querySelector('input[name="goods_usage"]:checked').value : '');
        postdata.append('goods_specification', document.querySelector('input[name="goods_specification"]:checked') ? document.querySelector('input[name="goods_specification"]:checked').value : '');

        postdata.append('brand_code', document.getElementById('brand_code').value);
        postdata.append('goods_price', document.getElementById('goods_price').value);
        postdata.append('goods_stock', document.getElementById('goods_stock').value);
        postdata.append('goods_end_user_margin', document.getElementById('goods_end_user_margin').value);
        postdata.append('goods_contractor_margin', document.getElementById('goods_contractor_margin').value);
        postdata.append('goods_reseller_margin', document.getElementById('goods_reseller_margin').value);
        postdata.append('goods_pricelist_margon', document.getElementById('goods_pricelist_margon').value);
        postdata.append('goods_end_user_price', document.getElementById('goods_end_user_price').value);
        postdata.append('goods_contractor_price', document.getElementById('goods_contractor_price').value);
        postdata.append('goods_reseller_price', document.getElementById('goods_reseller_price').value);
        postdata.append('goods_pricelist_price', document.getElementById('goods_pricelist_price').value);
        postdata.append('uom_code', document.getElementById('uom_code').value);
        postdata.append('goods_weight', document.getElementById('goods_weight').value);
        postdata.append('product_division_code', document.getElementById('product_division_code').value);
        postdata.append('product_category_code', document.getElementById('product_category_code').value);

        // Handle radio button lainnya
        postdata.append('goods_availability', document.querySelector('input[name="goods_availability"]:checked') ? document.querySelector('input[name="goods_availability"]:checked').value : '');

        postdata.append('goods_notes', document.getElementById('goods_notes').value);

        $.ajax({
            type: "POST",
            url: "/admin/goods",
            data: (postdata),
            processData: false, // Jangan ubah data
            contentType: false, // Atur tipe konten secara otomatis
            dataType: "json",
            async: false,
            success: function (data) {
                if (data.status == 401) {
                    showAlert('danger', "Form Wajib Diisi");
                    if (data.column == 'brand_code' || data.column == 'uom_code' || data.column == 'product_division_code' || data.column == 'product_category_code') {
                        alertform('select2',data.column,"Form ini Tidka Boleh Kosong");
                    } else if (data.column == 'goods_usage' || data.column == 'goods_specification' || data.column == 'goods_availability') {
                        alertform('radio',data.column,"Form ini Tidka Boleh Kosong");
                    } else if (data.column == 'goods_photo') {
                        alertform('file',data.column,"Form ini Tidka Boleh Kosong");
                    } else {
                        alertform('text',data.column,"Form ini Tidka Boleh Kosong");
                    }
                    return;
                } else if (data.status == 501) {
                    showAlert('danger', "Form Wajib Diisi");
                    if (data.column == 'brand_code' || data.column == 'uom_code' || data.column == 'product_division_code' || data.column == 'product_category_code') {
                        alertform('select2',data.column,"Form ini Tidka Boleh Kosong");
                    } else if (data.column == 'goods_usage' || data.column == 'goods_specification' || data.column == 'goods_availability') {
                        alertform('radio',data.column,"Form ini Tidka Boleh Kosong");
                    } else if (data.column == 'goods_photo') {
                        alertform('file',data.column,"Form ini Tidka Boleh Kosong");
                    } else{
                        alertform('text',data.column,"Form ini Tidka Boleh Kosong");
                    }
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

    function showedit(id){
        $.ajax({
            type: "GET",
            url: "/admin/goods/"+id,
            dataType: "json",
            async: false,
            success: function (data) {
                document.getElementById('goods_id').value = data.goods_id; 
                document.getElementById('goods_name').value = data.goods_name; 
                // if (data.goods_photo) {
                //     document.getElementById('goods_photo').value = data.goods_photo;
                // }
                document.querySelector(`input[name="goods_usage"][id="${data.goods_usage}"]`).checked = true;
                document.querySelector(`input[name="goods_specification"][id="${data.goods_specification}"]`).checked = true;
                $('#brand_code').append(new Option(data.brand_name, data.brand_code, true, true)).trigger('change');
                document.getElementById('goods_price').value = data.goods_price;
                document.getElementById('goods_stock').value = data.goods_stock;
                document.getElementById('goods_end_user_margin').value = data.goods_end_user_margin;
                document.getElementById('goods_contractor_margin').value = data.goods_contractor_margin;
                document.getElementById('goods_reseller_margin').value = data.goods_reseller_margin;
                document.getElementById('goods_pricelist_margon').value = data.goods_pricelist_margon;
                document.getElementById('goods_end_user_price').value = data.goods_end_user_price;
                document.getElementById('goods_contractor_price').value = data.goods_contractor_price;
                document.getElementById('goods_reseller_price').value = data.goods_reseller_price;
                document.getElementById('goods_pricelist_price').value = data.goods_pricelist_price;
                $('#uom_code').append(new Option(data.uom_name, data.uom_code, true, true)).trigger('change');
                document.getElementById('goods_weight').value = data.goods_weight;
                $('#product_division_code').append(new Option(data.product_divisions_name, data.product_division_code, true, true)).trigger('change');
                $('#product_category_code').append(new Option(data.product_category_name, data.product_category_code, true, true)).trigger('change');
                document.querySelector(`input[name="goods_availability"][id="${data.goods_availability}"]`).checked = true;
                document.getElementById('goods_notes').value = data.goods_notes;
                
                document.getElementById('tittleform').innerHTML = 'Form Detail & Edit';
                document.getElementById('saveclick').innerHTML = 'Save Changes';
                // Tampilkan modal
                $('#modalinput').modal('show')
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
        postdata.append('goods_name', document.getElementById('goods_name').value); 
        postdata.append('goods_photo', document.getElementById('goods_photo').files[0]); 

        // Handle radio button dengan pengecekan null
        postdata.append('goods_usage', document.querySelector('input[name="goods_usage"]:checked') ? document.querySelector('input[name="goods_usage"]:checked').value : '');
        postdata.append('goods_specification', document.querySelector('input[name="goods_specification"]:checked') ? document.querySelector('input[name="goods_specification"]:checked').value : '');

        postdata.append('brand_code', document.getElementById('brand_code').value);
        postdata.append('goods_price', document.getElementById('goods_price').value);
        postdata.append('goods_stock', document.getElementById('goods_stock').value);
        postdata.append('goods_end_user_margin', document.getElementById('goods_end_user_margin').value);
        postdata.append('goods_contractor_margin', document.getElementById('goods_contractor_margin').value);
        postdata.append('goods_reseller_margin', document.getElementById('goods_reseller_margin').value);
        postdata.append('goods_pricelist_margon', document.getElementById('goods_pricelist_margon').value);
        postdata.append('goods_end_user_price', document.getElementById('goods_end_user_price').value);
        postdata.append('goods_contractor_price', document.getElementById('goods_contractor_price').value);
        postdata.append('goods_reseller_price', document.getElementById('goods_reseller_price').value);
        postdata.append('goods_pricelist_price', document.getElementById('goods_pricelist_price').value);
        postdata.append('uom_code', document.getElementById('uom_code').value);
        postdata.append('goods_weight', document.getElementById('goods_weight').value);
        postdata.append('product_division_code', document.getElementById('product_division_code').value);
        postdata.append('product_category_code', document.getElementById('product_category_code').value);

        // Handle radio button lainnya
        postdata.append('goods_availability', document.querySelector('input[name="goods_availability"]:checked') ? document.querySelector('input[name="goods_availability"]:checked').value : '');

        postdata.append('goods_notes', document.getElementById('goods_notes').value);
        // console.log('Data FormData: ', Array.from(postdata.entries()));
        

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            type: "POST",
            url: "/admin/goods/"+id,
            data: (postdata),
            processData: false, // Jangan ubah data
            contentType: false, // Atur tipe konten secara otomatis
            dataType: "json",
            async: false,
            success: function (data) {
                
                if (data.status == 401) {
                    showAlert('danger', "Form Wajib Diisi");
                    if (data.column == 'brand_code' || data.column == 'uom_code' || data.column == 'product_division_code' || data.column == 'product_category_code') {
                        alertform('select2',data.column,"Form ini Tidka Boleh Kosong");
                    } else if (data.column == 'goods_usage' || data.column == 'goods_specification' || data.column == 'goods_availability') {
                        alertform('radio',data.column,"Form ini Tidka Boleh Kosong");
                    } else if (data.column == 'goods_photo') {
                        alertform('file',data.column,"Form ini Tidka Boleh Kosong");
                    } else {
                        alertform('text',data.column,"Form ini Tidka Boleh Kosong");
                    }
                    return;
                } else if (data.status == 501) {
                    showAlert('danger', "Form Wajib Diisi");
                    if (data.column == 'brand_code' || data.column == 'uom_code' || data.column == 'product_division_code' || data.column == 'product_category_code') {
                        alertform('select2',data.column,"Form ini Tidka Boleh Kosong");
                    } else if (data.column == 'goods_usage' || data.column == 'goods_specification' || data.column == 'goods_availability') {
                        alertform('radio',data.column,"Form ini Tidka Boleh Kosong");
                    } else if (data.column == 'goods_photo') {
                        alertform('file',data.column,"Form ini Tidka Boleh Kosong");
                    } else {
                        alertform('text',data.column,"Form ini Tidka Boleh Kosong");
                    }
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

    function delete_data(id){
        var postdata = {};
        postdata._token = document.getElementsByName('_token')[0].defaultValue;
        
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
                    type: "DELETE",
                    url: "/admin/goods/"+id,
                    data: (postdata),
                    dataType: "json",
                    async: false,
                    success: function (data) {
                        if (data.status == 401) {
                            showAlert('danger', data.data);
                            return;
                        } else if (data.status == 501) {
                            showAlert('danger', data.data);
                            return;
                        } else {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: 'Data has been deleted.',
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
        });
    }

</script>
@endsection

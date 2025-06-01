@extends('backend.layouts.master')

@section('title')
Inquiry - Admin Panel
@endsection

@php
    $usr = Auth::guard('web')->user();
    $homebase = session()->get('homebase_name');
    $date = session()->get('date_indo_format');
@endphp

@section('admin-content')

<style>
    .floating-footer {
        position: fixed;
        bottom: 8px;
        left: 250px; /* Sesuaikan dengan lebar sidebar */
        width: calc(100% - 250px); /* Agar footer tidak tertutup sidebar */
        background-color: #232b5c;
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 20px;
        font-family: Arial, sans-serif;
        z-index: 999; /* Pastikan berada di atas elemen lain */
        border-radius: 12px 12px 12px 12px;
    }

    .harga-total {
        font-size: 16px;
    }

    .harga-invalid {
        color: red;
    }

    .button-container {
        display: flex;
        gap: 10px;
    }

    /* Pastikan semua input dan select memiliki lebar yang sama */
    .form-control {
        width: 100%; /* Lebar 100% dari parent-nya */
        box-sizing: border-box; /* Pastikan padding dan border termasuk dalam lebar */
    }

    /* Jika ada elemen select yang masih bermasalah */
    #nama_customer, #user_code {
        width: 100% !important; /* Force lebar 100% */
    }

    .kategori-group {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .kategori-item {
        display: flex;
        align-items: center;
        gap: 5px;
        cursor: pointer;
    }

    .kategori-btn {
        width: 30px;
        height: 30px;
        border: 1px solid #ccc;
        background-color: white;
        cursor: pointer;
        border-radius: 5px;
        display: inline-block;
    }

    .kategori-btn.active {
        background-color: blue;
        border-color: blue;
        position: relative;
    }

    .kategori-btn.active::after {
        content: "✔";
        color: white;
        font-size: 18px;
        font-weight: bold;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    /* .kategori-item.selected {
        border: 2px solid #007bff;
        background-color: #e6f0ff;
    } */

</style>

<div class="content-wrapper">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 rt-mb-25">
                    <div class="breadcrumbs">
                        <div class="breadcrumb-title">Inquiry</div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href='/admin'>Home</a></li>
                                <li class="breadcrumb-item"><a href='/admin/inquiry'>Origin</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><a href='/admin/inquiry'>Inquiry</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-xxl-6 col-xl-6 col-md-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5>Detail Customer</h5>
                        </div>
                        <div class="card-body">
                            <!-- Nama -->
                            <div class="row mb-3 align-items-center" id="header_form_nama">
                                <label class="col-sm-4 col-form-label"><b>Nama</b></label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="nama_customer" style="width: 100%;">
                                        <option value="" disabled selected>Pilih Nama</option>
                                    </select>
                                </div>
                            </div>

                            <!-- User -->
                            <div class="row mb-3 align-items-center">
                                <label class="col-sm-4 col-form-label"><b>User</b></label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="user_code">
                                        <option value="1">Reseller</option>
                                        <option value="2">End User</option>
                                        <option value="3">Kontraktor</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Perusahaan -->
                            <div class="row mb-3 align-items-center">
                                <label class="col-sm-4 col-form-label"><b>Perusahaan</b></label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="text" id="company">
                                </div>
                            </div>

                            <!-- Alamat -->
                            <div class="row mb-3 align-items-center">
                                <label class="col-sm-4 col-form-label"><b>Alamat</b></label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="text" id="address">
                                </div>
                            </div>

                            <!-- Prov & Kota -->
                            <div class="row mb-3 align-items-center">
                                <label class="col-sm-4 col-form-label"><b>Prov & Kota</b></label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="text" id="city">
                                </div>
                            </div>

                            <!-- Telepon -->
                            <div class="row mb-3 align-items-center">
                                <label class="col-sm-4 col-form-label"><b>No. Tlpn</b></label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="text" id="phone">
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="row mb-3 align-items-center">
                                <label class="col-sm-4 col-form-label"><b>Email</b></label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="text" id="email">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informasi Permintaan -->
                <div class="col-xxl-6 col-xl-6 col-md-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5>Informasi Permintaan</h5>
                        </div>
                        <div class="card-body">
                            <!-- Dari -->
                            <div class="row mb-3 align-items-center" id="header_form_permintaan">
                                <label class="col-sm-4 col-form-label"><b>Dari</b></label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="hidden" id="permintaan_dari_name">
                                    <select class="form-control" id="permintaan_dari" style="width: 100%;">
                                        <option value="" disabled selected>Pilih Permintaan</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Lokasi -->
                            <div class="row mb-3 align-items-center">
                                <label class="col-sm-4 col-form-label"><b>Lokasi</b></label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="text" id="permintaan_lokasi" value="{{ $homebase }}, {{ $date }}">
                                </div>
                            </div>

                            <!-- Pengiriman -->
                            <div class="row mb-3 align-items-center">
                                <label class="col-sm-4 col-form-label"><b>Pengiriman</b></label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="permintaan_pengiriman">
                                        <option value="1">Kurir Bromindo</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Ongkir -->
                            <div class="row mb-3 align-items-center">
                                <label class="col-sm-4 col-form-label"><b>Ongkir</b></label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="number" id="permintaan_ongkir" placeholder="0" oninput="updateGrandTotal()">
                                </div>
                            </div>

                            <!-- Kategori -->
                            <!-- <div class="row mb-3 align-items-center">
                                <label class="col-sm-4 col-form-label"><b>Kategori</b></label>
                                <div class="col-sm-8">
                                    <div class="kategori-group d-flex gap-2 flex-wrap">
                                        <div class="kategori-item" data-value="FE">
                                            <div class="kategori-btn"></div><span>FE</span>
                                        </div>
                                        <div class="kategori-item" data-value="FA">
                                            <div class="kategori-btn"></div><span>FA</span>
                                        </div>
                                        <div class="kategori-item" data-value="FH">
                                            <div class="kategori-btn"></div><span>FH</span>
                                        </div>
                                        <div class="kategori-item" data-value="SE">
                                            <div class="kategori-btn"></div><span>SE</span>
                                        </div>
                                        <div class="kategori-item" data-value="FS">
                                            <div class="kategori-btn"></div><span>FS</span>
                                        </div>
                                    </div>
                                    <input type="hidden" id="kategoriInput" name="kategori">
                                </div>
                            </div> -->

                            <div class="row mb-3 align-items-center">
                                <label class="col-sm-4 col-form-label"><b>Kategori</b></label>
                                <div class="col-sm-8">
                                    <div class="kategori-group d-flex gap-2 flex-wrap" id="kategoriGroup">
                                        {{-- Akan diisi oleh JavaScript --}}
                                    </div>
                                    <input type="hidden" id="kategoriInput" name="kategori">
                                </div>
                            </div>


                            <!-- Gudang -->
                            <div class="row mb-3 align-items-center" id="header_form_gudang">
                                <label class="col-sm-4 col-form-label"><b>Stock</b></label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="hidden" id="permintaan_stock_name">
                                    <select class="form-control" id="permintaan_stock" style="width: 100%;">
                                        <option value="" disabled selected>Pilih Gudang</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Spesifikasi -->
                            <div class="row mb-3 align-items-center hidden">
                                <label class="col-sm-4 col-form-label"><b>Spesifikasi</b></label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="permintaan_spesifikasi">
                                        <option value="1">Low End</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-xxl-12 col-xl-12 col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5>List Permintaan</h5>
                            <div class="d-flex align-items-center">
                                <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#" onclick="showadddata()" style="color: #2563eb;"><i class="ph ph-plus"></i> Tambah Data</button>
                            </div>
                        </div>

                        <div class="card-body">
                                    
                            <div id="new_misi" style="border: 1px solid #d1d5db; border-radius: 8px; padding: 12px; display: flex; align-items: center; background-color: #f9fafb;">
                                <div style="color: #2563eb; font-size: 45px; margin-right: 10px;">ℹ️</div>
                                <div>
                                    <strong>Mulai Misi Baru! 🎉</strong><br>
                                    <span>Misi: Tambahkan barang sesuai kebutuhan customer. Reward: Kepuasan pelanggan meningkat!</span>
                                </div>
                            </div>

                            <table class="table hidden" id="table_misi">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Produk</th>
                                        <th class="text-center" style="width: 10%;">Qty</th>
                                        <th class="text-center">Stock</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Satuan</th>
                                        <th class="text-center">Harga / Unit</th>
                                        <th class="text-center">Harga NET</th>
                                        <th class="text-center">Taxes</th>
                                        <th class="text-center">Harga Total</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                    
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xxl-12 col-xl-12 col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5>Keterangan</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <textarea id="editor" name="content" class="form-control" data-desc="{{ $description }}"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="floating-footer">
    <div class="harga-total">
        Harga Total : <span class="harga-invalid" id="harga_keseluruhan"> 0 (Harga belum valid)</span><br>
        <input type="hidden" class="form-control" id="harga_keseluruhan_hide" value="0" readonly>
        <input type="hidden" class="form-control" id="harga_ppn" value="0" readonly>
        <input type="hidden" class="form-control" id="harga_tanpa_ppn" value="0" readonly>
        <small>* Termasuk PPN dan ongkir</small>
    </div>
    <div class="button-container">
        <button type="button" class="btn btn-warning" onclick="previewpdf()"><i class="ph ph-eye" style="font-size: 20px;"></i> Pratinjau</button>
        <button type="button" class="btn btn-primary" onclick="saveAll()"><i class="ph ph-floppy-disk" style="font-size: 20px;"></i> Simpan</button>
    </div>
</div>

<div class="modal fade" id="modalinput" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 50%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tittleform">Tambah Permintaan</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- <form id="requestProdukForm"> -->
                    <div class="fromGroup horizontal-form mb-3">
                        <label class="form-label">Request produk?</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="requestProdukSwitch" onclick="request()">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="namaBarang" class="form-label">Nama barang</label>
                        <input type="text" class="form-control hidden" id="namaBarangText" value="">
                        <input type="hidden" class="form-control" id="namaBarangSelect2" value="">
                        <input type="hidden" class="form-control" id="code_kategori" value="">
                        <div id=namaBarangCombo>
                            <select class="form-control" id="namaBarang" style="width: 100%;">
                                <option value="" disabled selected>Pilih Barang</option>
                            </select>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity" value="" onInput="hitung()">
                        </div>
                        <div class="col-md-6">
                            <label for="satuan" class="form-label">Satuan</label>
                            <input type="hidden" class="form-control" id="satuan_code" value="" readonly>
                            <input type="text" class="form-control" id="satuan" value="" readonly>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="hargaPricelist" class="form-label">Harga pricelist</label>
                            <input type="number" class="form-control" id="hargaPricelist" value="" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="hargaNet" class="form-label">Harga NET (End user)</label>
                            <input type="number" class="form-control" id="hargaNet" value="" onInput="hitung()" readonly>
                        </div>
                    </div>
                    <div class="mt-3">
                        <label for="hargaTotal" class="form-label">Harga Total (End user)</label>
                        <input type="text" class="form-control" id="hargaTotal" value="" readonly>
                    </div>
                <!-- </form> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="saveclick" onclick="tambahlist()"><i class="ph ph-floppy-disk"></i> Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- modal preview menggunakan iframe -->
<div class="modal fade" id="modalpreview" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="showppn()"></button>
            </div>
            <div class="modal-body">
                <iframe id="iframePreview" src="inquiry_supply_only/previewpdf" style="width: 100%; height: 80vh; border: none;"></iframe>
            </div>
        </div>
    </div>
</div>

<!-- <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script> -->
<script>

    document.addEventListener("DOMContentLoaded", function () {
        let editorElement = document.querySelector('#editor');
        let description = editorElement.getAttribute('data-desc'); // Ambil data dari attribute

        ClassicEditor
            .create(editorElement)
            .then(editor => {
                editor.setData(description); // Set data ke CKEditor
                window.myEditor = editor;
            })
            .catch(error => {
                console.error(error);
            });
    });

    let datakategori = [];

    $(document).ready(function() {   
        // console.log('list kategori', @json($listproduct));

        const listProduct = @json($listproduct); // convert PHP to JSON for JS
        const kategoriGroup = $('#kategoriGroup');

        listProduct.forEach(item => {
            const kategoriItem = `
                <div class="kategori-item" data-value="${item.code}">
                    <div class="kategori-btn"></div><span>${item.name}</span>
                </div>
            `;
            kategoriGroup.append(kategoriItem);
        });

        // Optional: add click event to select a category
        $(document).on('click', '.kategori-item', function () {
            $('.kategori-item').removeClass('selected');
            $(this).addClass('selected');
            $('#kategoriInput').val($(this).data('value'));
            // $(this).find('.kategori-btn').toggleClass('active');

            updateKategoriInput();
        });
        
        $(".kategori-item").click(function () {
            let btn = $(this).find(".kategori-btn");
            btn.toggleClass("active"); // Toggle class active

            datakategori = $(".kategori-item .kategori-btn.active").map(function () {
                return $(this).parent().data("value");
            }).get(); // Pastikan hasilnya array

            $("#kategoriInput").val(JSON.stringify(datakategori));

        }); 

        $('#nama_customer').on('select2:select', function(e) {
            var data = e.params.data;
            $('#company').val(data.text);
            $('#address').val(data.customers_full_address);
            $('#city').val(data.provinces_name+" & "+data.cities_name);
            $('#phone').val(data.customers_phone);
            $('#email').val(data.customers_email);
        }).on("select2:unselect", function (e) {
            // clear data
        }).select2({
            placeholder: "Pilih Nama",
            allowClear: true,
            ajax: {
                url: '/admin/combocustomer',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        search: params.term,
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

        $('#permintaan_dari').on('select2:select', function(e) {
            var data = e.params.data;
            $('#permintaan_dari_name').val(data.text);
        }).on("select2:unselect", function (e) {
            // clear data
        }).select2({
            placeholder: "Pilih Permintaan",
            allowClear: true,
            ajax: {
                url: '/admin/comboorigininquiries',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        search: params.term,
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

        $('#permintaan_stock').on('select2:select', function(e) {
            var data = e.params.data;
            $('#permintaan_stock_name').val(data.text);
        }).on("select2:unselect", function (e) {
            // clear data
        }).select2({
            placeholder: "Pilih Gudang",
            allowClear: true,
            ajax: {
                url: '/admin/combowarehouse',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        search: params.term,
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
            

        $('#modalinput').on('shown.bs.modal', function () {
            $('#header_form_nama').addClass('hidden');
            $('#header_form_permintaan').addClass('hidden');
            $('#header_form_gudang').addClass('hidden');
            $('.pph-input-data').addClass('hidden');
            // $('.pph-input-data').css('display','none');
            
            $('#namaBarang').on('select2:select', function(e) {
                var data = e.params.data;
                $('#satuan_code').val(data.uom_code);
                $('#satuan').val(data.uom_name);
                $('#hargaPricelist').val(data.goods_price);
                $('#namaBarangSelect2').val(data.text);
                $('#code_kategori').val(data.product_division_code);
                var user_code = $('#user_code').val();
                if (user_code == 1) {
                    $('#hargaNet').val(data.goods_reseller_price);
                } else if (user_code == 2) {
                    $('#hargaNet').val(data.goods_end_user_price);
                }else if (user_code == 3) {
                    $('#hargaNet').val(data.goods_contractor_price);
                } else {
                    $('#hargaNet').val(data.goods_price);
                }
            }).on("select2:unselect", function (e) {
                // clear data
            }).select2({
                dropdownParent: $('#modalinput'),
                placeholder: "Pilih Barang",
                allowClear: true,
                ajax: {
                    url: '/admin/combogoods',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            search: params.term,
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

        $('#modalinput').on('hidden.bs.modal', function () {
            $('#header_form_nama').removeClass('hidden');
            $('#header_form_permintaan').removeClass('hidden');
            $('#header_form_gudang').removeClass('hidden');
            // $('.pph-input-data').css('display','block');
            $('.pph-input-data').removeClass('hidden');
        });
    
        $('#closeModal').on('click', function () {
            $('#header_form_nama').removeClass('hidden');
            $('#header_form_permintaan').removeClass('hidden');
            $('#header_form_gudang').removeClass('hidden');
            // $('.pph-input-data').css('display','block');
            $('.pph-input-data').removeClass('hidden');
        });
    });

    function pilihkategori(kode_kategori) {
        const kategoriItem = $(`.kategori-item[data-value="${kode_kategori}"]`);
        if (kategoriItem.length) {
            const btn = kategoriItem.find('.kategori-btn');
            btn.toggleClass('active');
            updateKategoriInput(); // ← ini penting!
        }
    }

    function updateKategoriInput() {
        datakategori = $(".kategori-item .kategori-btn.active").map(function () {
            return $(this).parent().data("value");
        }).get();

        $("#kategoriInput").val(JSON.stringify(datakategori));
    }


    function getEditorValue() {
        var content = window.myEditor.getData();
        return content;
    }
    

    function request() {
        const checkreq = $('#requestProdukSwitch').prop('checked');
        if (checkreq == false) {
            $('#namaBarangText').addClass('hidden');
            $('#namaBarangCombo').removeClass('hidden');

            $('#satuan').prop('readonly', true);
            $('#hargaPricelist').prop('readonly', true);
            $('#hargaNet').prop('readonly', true);
        } else {
            $('#namaBarangCombo').addClass('hidden');
            $('#namaBarangText').removeClass('hidden');
            
            $('#satuan').removeAttr('readonly');
            $('#hargaPricelist').removeAttr('readonly');
            $('#hargaNet').removeAttr('readonly');
            $('#hargaPricelist').val(0);
            $('#hargaNet').val(0);
        }
    }

    function showadddata() {
        let name = $('#nama_customer').val();
        let user = $('#user_code').val();

        if (name == null) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Pilih nama customer terlebih dahulu!'
            });

            alertform('select2','nama_customer',"Form ini Tidak Boleh Kosong");
            return;
        }

        if (user == null) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Pilih user terlebih dahulu!'
            });
            alertform('select2','user_code',"Form ini Tidak Boleh Kosong");
            return;
        }

        $('#modalinput').modal('show');
    }

    function tambahlist() {
        const checkreq = $('#requestProdukSwitch').prop('checked');
        let namaBarang, status, stok;

        if (checkreq == false) {
            namaBarang = $('#namaBarangSelect2').val();
            status = '<p style="color: green;">Ready</p>';
            stok = 1;
            code_status = 2; // ready
        } else {
            namaBarang = $('#namaBarangText').val();
            status = '<p style="color: red;">Tidak ditemukan disistem</p>';
            stok = 0;
            code_status = 3; // not value in system

            if(namaBarang == null || namaBarang == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Mohon isi nama barang terlebih dahulu!'
                });

                return;
            }
        }

        let quantity = $('#quantity').val();
        let satuan_code = $('#satuan_code').val();
        let satuan = $('#satuan').val();
        let hargaPricelist = $('#hargaPricelist').val();
        let hargaNet = $('#hargaNet').val();
        let no = $('#tbody tr').length + 1;
        let ppn = 12; // Default PPN 12%
        let kodebarang = $('#namaBarang').val();

        let hargaTotal = (quantity * hargaNet);

        if(satuan == null || satuan == "") {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Mohon isi satuan terlebih dahulu!'
            });

            return;
        }

        if(hargaNet == null || hargaNet == "" || hargaNet == 0) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Harga Net tidak boleh kosong!'
            });

            return;
        }

        $('#modalinput').modal('hide');

        $('#table_misi').removeClass('hidden');
        $('#new_misi').addClass('hidden');
        $('#header_form_nama').removeClass('hidden');
        $('#header_form_permintaan').removeClass('hidden');
        $('#header_form_gudang').removeClass('hidden');
        // $('.pph-input-data').css('display','block');
        $('.pph-input-data').removeClass('hidden');

        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Level Up! Permintaan Baru Ditambahkan!',
        })

        pilihkategori($('#code_kategori').val()); 

        $('#tbody').append(`
            <tr>
                <td class="text-center">${no}</td>
                <td class="hidden">${kodebarang}</td>
                <td>${namaBarang}</td>
                <td><input type="number" value="${quantity}" class="quantity-input" oninput="updateHargaTotal(this)"></td>
                <td class="text-center">${stok}</td>
                <td class="hidden">${code_status}</td>
                <td>${status}</td>
                <td class="hidden">${satuan_code}</td>
                <td>${satuan}</td>
                <td class="text-center">${hargaPricelist}</td>
                <td class="harga-net text-center">${hargaNet}</td>
                <td class="pph-input-data text-center">
                    <select class="ppn-input select2-ppn form-control" onchange="updateHargaTotal(this)">
                        <option value="" selected>Pilih PPN</option>
                    </select>
                </td>
                <td class="harga-total text-center">${hargaTotal.toFixed(0)}</td>
                <td>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-danger" onclick="hapuslist(this)">
                            <i class="ph ph-trash"></i>
                        </button>
                        <button type="button" class="btn btn-primary" onclick="moveUp(this)">
                            <i class="ph ph-arrow-up"></i>
                        </button>
                        <button type="button" class="btn btn-primary" onclick="moveDown(this)">
                            <i class="ph ph-arrow-down"></i>
                        </button>
                    </div>
                </td>
            </tr>
        `);

        $('.select2-ppn').select2({
            placeholder: "PPN",
            allowClear: true,
            ajax: {
                url: '/admin/combotaxes', 
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        search: params.term,
                    };
                },
                processResults: function (data) {
                    return {
                        results: data 
                    };
                },
                cache: true
            },
        });

        updateGrandTotal();
    }

    function updateHargaTotal(input) {
        let row = $(input).closest("tr"); // Dapatkan baris tabel yang sedang diedit
        let quantity = parseFloat(row.find(".quantity-input").val()) || 0;
        let hargaNet = parseFloat(row.find(".harga-net").text()) || 0;
        let ppnText = row.find(".ppn-input").val().replace('%', ''); // Ambil nilai PPN tanpa simbol "%"
        let ppn = parseFloat(ppnText) || 0; // Konversi ke angka

        let hargaTotal = (quantity * hargaNet) * (1 + ppn / 100);

        row.find(".harga-total").text(hargaTotal.toFixed(2));
        updateGrandTotal();
    }

    function updateGrandTotal() {
        let grandTotal = 0;
        let totalHargaTanpaTaxes = 0;
        let totalTaxes = 0;
        let ongkir = parseFloat($("#permintaan_ongkir").val()) || 0;

        $(".harga-total").each(function () {
            let row = $(this).closest("tr");
            let quantity = parseFloat(row.find(".quantity-input").val()) || 0;
            let hargaNet = parseFloat(row.find(".harga-net").text()) || 0;

            let ppnElement = row.find(".ppn-input");
            let ppnText = ppnElement.length > 0 ? ppnElement.val() : "0"; // Pastikan selalu ada nilai
            let ppn = parseFloat(ppnText.replace('%', '')) || 0; // Hapus simbol "%" jika ada, pastikan konversi angka

            let hargaTanpaTaxes = quantity * hargaNet; // Harga sebelum pajak
            let taxAmount = hargaTanpaTaxes * (ppn / 100); // Pajak yang dikenakan
            let hargaTotal = hargaTanpaTaxes + taxAmount; // Harga setelah pajak

            totalHargaTanpaTaxes += hargaTanpaTaxes;
            totalTaxes += taxAmount;
            grandTotal += hargaTotal;
        });

        let total_plus_ongkir = grandTotal + ongkir;

        $("#harga_ppn").text(totalTaxes.toFixed(2));
        $("#harga_tanpa_ppn").text(totalHargaTanpaTaxes.toFixed(2));

        $("#harga_keseluruhan").text(total_plus_ongkir.toFixed(2));
        $("#harga_keseluruhan_hide").val(total_plus_ongkir.toFixed(2));
    }



    function hitung() {
        var quantity = $('#quantity').val();
        var hargaNet = $('#hargaNet').val();
        var hargaTotal = quantity * hargaNet;
        $('#hargaTotal').val(hargaTotal);
    }

    function hapuslist(button) {
        let row = button.closest("tr");
        row.remove();
        updateRowNumbers();

        updateGrandTotal();
    }

    function moveUp(button) {
        let row = button.closest("tr");
        let prevRow = row.previousElementSibling;

        if (prevRow) {
            row.parentNode.insertBefore(row, prevRow);
            updateRowNumbers();
        }
    }

    function moveDown(button) {
        let row = button.closest("tr");
        let nextRow = row.nextElementSibling;

        if (nextRow) {
            row.parentNode.insertBefore(nextRow, row);
            updateRowNumbers();
        }
    }

    function updateRowNumbers() {
        let rows = document.querySelectorAll("#tbody tr");
        rows.forEach((row, index) => {
            row.cells[0].textContent = index + 1;
        });
    }

    function alertError(message) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: message
        });
    }

    function saveAll() {

        let name = $('#nama_customer').val();
        let user = $('#user_code').val();

        if (name == null) {
            alertError('Pilih nama customer terlebih dahulu!');
            alertform('select2','nama_customer',"Form ini Tidak Boleh Kosong");
            return;
        }

        if (user == null) {
            alertError('Pilih user terlebih dahulu!');
            alertform('select2','user_code',"Form ini Tidak Boleh Kosong");
            return;
        }

        // Validasi Header Fields
        var headerFields = [
            'nama_customer', 'company', 'address', 'city', 'phone', 'email',
            'permintaan_dari', 'permintaan_dari_name', 'permintaan_lokasi', 'permintaan_pengiriman',
            'permintaan_ongkir', 'permintaan_stock', 'permintaan_stock_name',
        ];

        for (var i = 0; i < headerFields.length; i++) {
            var field = document.getElementById(headerFields[i]);
            if (!field || field.value.trim() === '') {
                alertError("Field '" + headerFields[i].replace(/_/g, ' ') + "' wajib diisi.");
                return;
            }
        }

        // Editor value
        var keterangan = getEditorValue();
        if (!keterangan || keterangan.trim() === '') {
            alertError("Keterangan wajib diisi.");
            return;
        }

        // Validasi datakategori
        if (!Array.isArray(datakategori) || datakategori.length === 0 || !datakategori[0]) {
            alertError("Kategori wajib diisi.");
            return;
        }


        var postdata = new FormData();
        postdata.append('_token', document.getElementsByName('_token')[0].defaultValue);

        postdata.append('nama_customer', document.getElementById('nama_customer').value);

        var user_code = document.getElementById('user_code').value;
        if(user_code == 1) {
            postdata.append('user_code', "Reseller");
        } else if (user_code == 2) {
            postdata.append('user_code', "End User");
        } else if (user_code == 3) {
            postdata.append('user_code', "Kontraktor");
        } else {
            postdata.append('user_code', "Reseller");
        }
        postdata.append('company', document.getElementById('company').value); // nama customer
        postdata.append('address', document.getElementById('address').value); 
        postdata.append('city', document.getElementById('city').value); 
        postdata.append('phone', document.getElementById('phone').value); 
        postdata.append('email', document.getElementById('email').value); 

        postdata.append('permintaan_dari', document.getElementById('permintaan_dari').value); 
        postdata.append('permintaan_dari_name', document.getElementById('permintaan_dari_name').value); 
        postdata.append('permintaan_lokasi', document.getElementById('permintaan_lokasi').value); 
        postdata.append('permintaan_pengiriman', document.getElementById('permintaan_pengiriman').value); 
        postdata.append('permintaan_pengiriman_name', "Kurir Bromindo"); 
        postdata.append('permintaan_ongkir', document.getElementById('permintaan_ongkir').value); 
        postdata.append('permintaan_stock', document.getElementById('permintaan_stock').value); 
        postdata.append('permintaan_stock_name', document.getElementById('permintaan_stock_name').value); 
        postdata.append('permintaan_spesifikasi', document.getElementById('permintaan_spesifikasi').value); 
        postdata.append('keterangan', getEditorValue()); 
        postdata.append('harga_total', document.getElementById('harga_keseluruhan_hide').value);
        postdata.append('harga_ppn', document.getElementById('harga_ppn').value);
        postdata.append('harga_tanpa_ppn', document.getElementById('harga_tanpa_ppn').value);
        postdata.append('kategori', datakategori);
        postdata.append('nomor_left', datakategori[0]);

        var tbody = document.getElementById('tbody');
        var rows = tbody.getElementsByTagName('tr');

        if (rows.length === 0) {
            alertError("Detail produk minimal satu baris wajib diisi.");
            return;
        }

        var details = [];

        for (var i = 0; i < rows.length; i++) {
            var cells = rows[i].getElementsByTagName('td');
            
            const checkreq = $('#requestProdukSwitch').prop('checked');
            if (checkreq == false) {
                var satuan_barang = cells[7].innerText.trim();
            } else {
                var satuan_barang = cells[8].innerText.trim();
            }

            var qtyInput = cells[3].querySelector('input');
            var taxesSelect = cells[11].querySelector("select");

            if (!qtyInput || qtyInput.value.trim() === '') {
                alertError("Qty pada baris ke-" + (i + 1) + " wajib diisi.");
                return;
            }

            if (!taxesSelect || taxesSelect.value.trim() === '') {
                alertError("Taxes pada baris ke-" + (i + 1) + " wajib diisi.");
                return;
            }

            var detail = {
                no: cells[0].innerText.trim(),
                produk_code: cells[1].innerText.trim(),
                produk_name: cells[2].innerText.trim(),
                qty: cells[3].querySelector('input').value.trim(),
                stock: cells[4].innerText.trim(),
                status: cells[5].innerText.trim(),
                status_name: cells[6].innerText.trim(),
                satuan: satuan_barang,
                harga_unit: cells[9].innerText.trim(),
                harga_net: cells[10].innerText.trim(),
                taxes: cells[11].querySelector("select").value.trim(),
                harga_total: cells[12].innerText.trim()
            };

            details.push(detail);
        }

        postdata.append('details', JSON.stringify(details));

        $.ajax({
            type: "POST",
            url: "/admin/inquiry_supply_only",
            data: (postdata),
            processData: false, // Jangan ubah data
            contentType: false, // Atur tipe konten secara otomatis
            dataType: "json",
            async: false,
            success: function (data) {
                if (data.status == 401) {
                    showAlert('danger', "Form Wajib Diisi");
                    if (data.column == 'department_code') {
                        alertform('select2',data.column,"Form ini Tidak Boleh Kosong");
                    } else {
                        alertform('text',data.column,"Form ini Tidak Boleh Kosong");
                    }
                    return;
                } else if (data.status == 501) {
                    showAlert('danger', "Form Wajib Diisi");
                    if (data.column == 'department_code') {
                        alertform('select2',data.column,"Form ini Tidak Boleh Kosong");
                    } else {
                        alertform('text',data.column,"Form ini Tidak Boleh Kosong");
                    }
                    return;
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Data Saved!',
                    }).then(function() {
                        // location.reload();
                        window.location.href = "/admin/inquiry";
                    });
                }
            },
            error: function (dataerror) {
                alertError(dataerror.responseJSON.message);
            }
        });

    }

    async function previewpdf() {

        let name = $('#nama_customer').val();
        let user = $('#user_code').val();

        if (name == null) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Pilih nama customer terlebih dahulu!'
            });

            alertform('select2','nama_customer',"Form ini Tidak Boleh Kosong");
            return;
        }

        if (user == null) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Pilih user terlebih dahulu!'
            });
            alertform('select2','user_code',"Form ini Tidak Boleh Kosong");
            return;
        }


        var postdata = new FormData();
        postdata.append('_token', document.getElementsByName('_token')[0].defaultValue);

        postdata.append('nama_customer', document.getElementById('nama_customer').value); 
        postdata.append('user_code', document.getElementById('user_code').value); 
        postdata.append('company', document.getElementById('company').value); // nama customer
        postdata.append('address', document.getElementById('address').value); 
        postdata.append('city', document.getElementById('city').value); 
        postdata.append('phone', document.getElementById('phone').value); 
        postdata.append('email', document.getElementById('email').value); 

        postdata.append('permintaan_dari', document.getElementById('permintaan_dari').value); 
        postdata.append('permintaan_dari_name', document.getElementById('permintaan_dari_name').value); 
        postdata.append('permintaan_lokasi', document.getElementById('permintaan_lokasi').value); 
        postdata.append('permintaan_pengiriman', document.getElementById('permintaan_pengiriman').value); 
        postdata.append('permintaan_pengiriman_name', "Kurir Bromindo"); 
        postdata.append('permintaan_ongkir', document.getElementById('permintaan_ongkir').value); 
        // postdata.append('kategoriInput', document.getElementById('kategoriInput').value); 
        postdata.append('permintaan_stock', document.getElementById('permintaan_stock').value); 
        postdata.append('permintaan_stock_name', document.getElementById('permintaan_stock_name').value); 
        postdata.append('permintaan_spesifikasi', document.getElementById('permintaan_spesifikasi').value); 
        postdata.append('keterangan', getEditorValue()); 
        postdata.append('harga_total', document.getElementById('harga_keseluruhan_hide').value);
        postdata.append('harga_ppn', document.getElementById('harga_ppn').value);
        postdata.append('harga_tanpa_ppn', document.getElementById('harga_tanpa_ppn').value);
        postdata.append('kategori', datakategori);
        postdata.append('nomor_left', datakategori[0]);


        var tbody = document.getElementById('tbody');
        var rows = tbody.getElementsByTagName('tr');

        var details = [];

        for (var i = 0; i < rows.length; i++) {
            var cells = rows[i].getElementsByTagName('td');

            // const checkreq = $('#requestProdukSwitch').prop('checked');
            // if (checkreq == false) {
            //     var satuan_barang = cells[7].innerText.trim();
            // } else {
            //     var satuan_barang = cells[8].innerText.trim();
            // }

            var detail = {
                no: cells[0].innerText.trim(),
                produk_code: cells[1].innerText.trim(),
                produk_name: cells[2].innerText.trim(),
                qty: cells[3].querySelector('input').value.trim(),
                stock: cells[4].innerText.trim(),
                status: cells[5].innerText.trim(),
                status_name: cells[6].innerText.trim(),
                satuan: cells[8].innerText.trim(),
                harga_unit: cells[9].innerText.trim(),
                harga_net: cells[10].innerText.trim(),
                taxes: cells[11].querySelector("select").value.trim(),
                harga_total: cells[12].innerText.trim()
            };

            details.push(detail);
        }

        postdata.append('details', JSON.stringify(details));

        try {
            const response = await fetch("inquiry_supply_only/previewpdf", {
                method: 'POST',
                body: postdata
            });

            if (!response.ok) throw new Error('Network response was not ok');

            const blob = await response.blob();
            const url = URL.createObjectURL(blob);

            let iframe = document.getElementById('iframePreview');
            iframe.src = url;
            // $('.pph-input-data').css('display','none');
            $('.pph-input-data').addClass('hidden');
            $('#header_form_nama').addClass('hidden');
            $('#header_form_permintaan').addClass('hidden');
            $('#header_form_gudang').addClass('hidden');
            $('#modalpreview').modal('show');
        } catch (error) {
            console.error('Error:', error);
            Swal.fire('Error', 'Gagal memuat preview PDF', 'error');
        }

    }

    function showppn() {
        // $('.pph-input-data').css('display','block');
        $('.pph-input-data').removeClass('hidden');
        $('#header_form_nama').removeClass('hidden');
        $('#header_form_permintaan').removeClass('hidden');
        $('#header_form_gudang').removeClass('hidden');
    }
</script>

@endsection

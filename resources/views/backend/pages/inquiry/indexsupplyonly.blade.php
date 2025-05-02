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
                            <!-- Form Nama -->
                            <div class="fromGroup horizontal-form mb-3" id="header_form_nama">
                                <label><b>Nama</b></label>
                                <select class="form-control" id="nama_customer" style="width: 100%;">
                                    <option value="" disabled selected>Pilih Nama</option>
                                </select>
                            </div>

                            <!-- Form User -->
                            <div class="fromGroup horizontal-form mb-3">
                                <label><b>User</b></label>
                                <select class="form-control" id="user_code">
                                    <option value="1">Reseller</option>
                                    <option value="2">End User</option>
                                    <option value="3">Kontraktor</option>
                                </select>
                            </div>

                            <!-- Form Perusahaan -->
                            <div class="fromGroup horizontal-form mb-3">
                                <label><b>Perusahaan</b></label>
                                <input class="form-control" type="text" id="company">
                            </div>

                            <!-- Form Alamat -->
                            <div class="fromGroup horizontal-form mb-3">
                                <label><b>Alamat</b></label>
                                <input class="form-control" type="text" id="address">
                            </div>

                            <!-- Form Prov & Kota -->
                            <div class="fromGroup horizontal-form mb-3">
                                <label><b>Prov & Kota</b></label>
                                <input class="form-control" type="text" id="city">
                            </div>

                            <!-- Form No. Tlpn -->
                            <div class="fromGroup horizontal-form mb-3">
                                <label><b>No. Tlpn</b></label>
                                <input class="form-control" type="text" id="phone">
                            </div>

                            <!-- Form Email -->
                            <div class="fromGroup horizontal-form mb-3">
                                <label><b>Email</b></label>
                                <input class="form-control" type="text" id="email">
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-xxl-6 col-xl-6 col-md-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5>Informasi Permintaan</h5>
                        </div>
                        
                        <!-- ambil dari api raja ongkir -->
                        <div class="card-body">
                            <div class="fromGroup horizontal-form mb-3" id="header_form_permintaan">
                                <label><b>Dari</b></label>
                                <input class="form-control" type="hidden" id="permintaan_dari_name"> 
                                <select class="form-control" id="permintaan_dari" style="width: 100%;">
                                    <option value="" disabled selected>Pilih Permintaan</option>
                                </select>
                            </div>
                            <div class="fromGroup horizontal-form mb-3">
                                <label><b>Lokasi</b></label>
                                <input class="form-control" type="text" id="permintaan_lokasi" value="{{ $homebase }}, {{ $date }}">
                            </div>
                            <div class="fromGroup horizontal-form mb-3">
                                <label><b>Pengiriman</b></label>
                                <!-- <input class="form-control" type="text"> -->
                                 <select class="form-control" id="permintaan_pengiriman">
                                    <option value="1">Kurir Bromindo</option>
                                 </select>
                            </div>
                            <div class="fromGroup horizontal-form mb-3">
                                <label><b>Ongkir</b></label>
                                <input class="form-control" type="text" id="permintaan_ongkir" value="" placeholder="0">
                            </div>
                            <div class="fromGroup horizontal-form mb-3">
                                <label><b>Kategori</b></label>
                                <!-- <input class="form-control" type="text"> -->
                                <div class="kategori-group">
                                    <div class="kategori-item" data-value="FE">
                                        <div class="kategori-btn"></div>
                                        <span>FE</span>
                                    </div>
                                    <div class="kategori-item" data-value="FA">
                                        <div class="kategori-btn"></div>
                                        <span>FA</span>
                                    </div>
                                    <div class="kategori-item" data-value="FH">
                                        <div class="kategori-btn"></div>
                                        <span>FH</span>
                                    </div>
                                    <div class="kategori-item" data-value="SE">
                                        <div class="kategori-btn"></div>
                                        <span>SE</span>
                                    </div>
                                    <div class="kategori-item" data-value="FS">
                                        <div class="kategori-btn"></div>
                                        <span>FS</span>
                                    </div>
                                </div>
                                <input type="hidden" id="kategoriInput" name="kategori">
                            </div>
                            <div class="fromGroup horizontal-form mb-3">
                                <label><b>Stock</b></label>
                                <!-- <input class="form-control" type="text"> -->
                                 <select class="form-control" id="permintaan_stock">
                                    <option value="WRH0001">Gudang Semarang</option>
                                 </select>
                            </div>
                            <div class="fromGroup horizontal-form mb-3">
                                <label><b>Spesifikasi</b></label>
                                <!-- <input class="form-control" type="text"> -->
                                 <select class="form-control" id="permintaan_spesifikasi">
                                    <option value="1">Low End</option>
                                </select>
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
                                        <th class="text-center">Qty</th>
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


    // ClassicEditor
    //     .create(document.querySelector('#editor'))
    //     .then(editor => {
            // editor.setData(`{!! old('content', $post->content ?? '') !!}`); // contoh value ambil dari dabaase
            // editor.setData(`
            //     1. Harga sudah termasuk PPN 11%. <br>
            //     2. Pembayaran Melalui Cheque / Giro Atas Nama : PT. Patigeni Mitra Sejati dianggap lunas setelah Cheque / Giro dicairkan. Pembayaran melalui Transfer hanya melalui rekening 
            //     BCA AN PT. Patigeni Mitra Sejati BCA Ungaran a/c IDR : 222068B111 Bank Mandiri Pemuda a/c : 1350078787577 Kami tidak bertanggung jawab atas transaksi diluar akun tersebut. <br>
            //     3. Stock : Mohon konfirmasi sales. <br>
            //     4. Franco : Jakarta, Semarang, Surabaya. <br>
            //     5. Pembayaran : Cash Before Delivery. <br>
            //     6. Validasi penawaran : 7 hari kerja. <br>
            //     7. Harga tidak termasuk jasa instalasi (Supply Only). <br>
            //     8. Barang yang sudah dibeli tidak dapat ditukar / dikembalikan. <br>
            //     9. Email resmi perusahaan adalah email yang menggunakan domain @patigeni.com diluar akun tersebut dianggap tidak SAH. <br>
            // `);

        //     window.myEditor = editor;
        // })
        // .catch(error => {
        //     console.error(error);
        // });

    let datakategori = [];

    $(document).ready(function() {   
        $(".kategori-item").click(function () {
            let btn = $(this).find(".kategori-btn");
            btn.toggleClass("active"); // Toggle class active

            // Update daftar kategori yang dipilih
            datakategori = $(".kategori-item .kategori-btn.active").map(function () {
                return $(this).parent().data("value");
            }).get(); // Pastikan hasilnya array

            // Konversi ke format JSON
            $("#kategoriInput").val(JSON.stringify(datakategori));

            console.log(datakategori);
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
            $('#permintaan_dari').val(data.text);
            // $('#address').val(data.customers_full_address);
            // $('#city').val(data.provinces_code+" & "+data.cities_code);
            // $('#phone').val(data.customers_phone);
            // $('#email').val(data.customers_email);
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
            

        $('#modalinput').on('shown.bs.modal', function () {
            $('#header_form_nama').addClass('hidden');
            $('#header_form_permintaan').addClass('hidden');
            $('.pph-input-data').css('display','none');
            
            $('#namaBarang').on('select2:select', function(e) {
                var data = e.params.data;
                $('#satuan').val(data.uom_name);
                $('#hargaPricelist').val(data.goods_price);
                $('#namaBarangSelect2').val(data.text);
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
            // Tampilkan kembali Select2 di luar modal saat modal ditutup
            $('#header_form_nama').removeClass('hidden');
            $('#header_form_permintaan').removeClass('hidden');
            $('.pph-input-data').css('display','block');
        });
    
        $('#closeModal').on('click', function () {
            // Jika tombol close diklik, pastikan Select2 kembali tampil
            $('#header_form_nama').removeClass('hidden');
            $('#header_form_permintaan').removeClass('hidden');
            $('.pph-input-data').css('display','block');
        });
    });

    function getEditorValue() {
        var content = window.myEditor.getData();
        // console.log(content);
        return content;
    }
    

    function request() {
        // console.log(value);
        const checkreq = $('#requestProdukSwitch').prop('checked');
        if (checkreq == false) {
            $('#namaBarangText').addClass('hidden');
            $('#namaBarangCombo').removeClass('hidden');

            $('#satuan').prop('readonly', true);
            $('#hargaPricelist').prop('readonly', true);
            $('#hargaNet').prop('readonly', true);
            // $('#hargaTotal').prop('readonly', true);
        } else {
            $('#namaBarangCombo').addClass('hidden');
            $('#namaBarangText').removeClass('hidden');
            
            $('#satuan').removeAttr('readonly');
            $('#hargaPricelist').removeAttr('readonly');
            $('#hargaNet').removeAttr('readonly');
            $('#hargaPricelist').val(0);
            $('#hargaNet').val(0);
            // $('#hargaTotal').removeAttr('readonly');
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
        $('#modalinput').modal('hide');

        $('#table_misi').removeClass('hidden');
        $('#new_misi').addClass('hidden');
        $('#header_form_nama').removeClass('hidden');
        $('#header_form_permintaan').removeClass('hidden');
        $('.pph-input-data').css('display','block');

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
        }

        let quantity = $('#quantity').val();
        let satuan = $('#satuan').val();
        let hargaPricelist = $('#hargaPricelist').val();
        let hargaNet = $('#hargaNet').val();
        let no = $('#tbody tr').length + 1;
        let ppn = 12; // Default PPN 12%
        let kodebarang = $('#namaBarang').val();

        // Hitung harga total awal
        // let hargaTotal = (quantity * hargaNet) * (1 + ppn / 100);
        let hargaTotal = (quantity * hargaNet);

        $('#tbody').append(`
            <tr>
                <td class="text-center">${no}</td>
                <td class="hidden">${kodebarang}</td>
                <td>${namaBarang}</td>
                <td><input type="number" value="${quantity}" class="quantity-input" oninput="updateHargaTotal(this)"></td>
                <td>${stok}</td>
                <td class="hidden">${code_status}</td>
                <td>${status}</td>
                <td>${satuan}</td>
                <td>${hargaPricelist}</td>
                <td class="harga-net">${hargaNet}</td>
                <td class="pph-input-data" style="display: block;">
                    <select class="ppn-input select2-ppn form-control" onchange="updateHargaTotal(this)">
                        <option value="" selected>Pilih PPN</option>
                    </select>
                </td>
                <td class="harga-total">${hargaTotal.toFixed(0)}</td>
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

        // Inisialisasi Select2 pada elemen yang baru ditambahkan
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

        // Update grand total setelah menambah item
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

        $(".harga-total").each(function () {
            let row = $(this).closest("tr");
            let quantity = parseFloat(row.find(".quantity-input").val()) || 0;
            let hargaNet = parseFloat(row.find(".harga-net").text()) || 0;

            // Ambil elemen select PPN dengan pengecekan apakah ditemukan
            let ppnElement = row.find(".ppn-input");
            let ppnText = ppnElement.length > 0 ? ppnElement.val() : "0"; // Pastikan selalu ada nilai
            let ppn = parseFloat(ppnText.replace('%', '')) || 0; // Hapus simbol "%" jika ada, pastikan konversi angka

            let hargaTanpaTaxes = quantity * hargaNet; // Harga sebelum pajak
            let taxAmount = hargaTanpaTaxes * (ppn / 100); // Pajak yang dikenakan
            let hargaTotal = hargaTanpaTaxes + taxAmount; // Harga setelah pajak

            // Akumulasi total
            totalHargaTanpaTaxes += hargaTanpaTaxes;
            totalTaxes += taxAmount;
            grandTotal += hargaTotal;
        });

        // Debugging di Console
        // console.log("Total Harga Tanpa Taxes:", totalHargaTanpaTaxes.toFixed(2));
        // console.log("Total Taxes:", totalTaxes.toFixed(2));
        // console.log("Grand Total (Harga + Taxes):", grandTotal.toFixed(2));
        $("#harga_ppn").text(totalTaxes.toFixed(2));
        $("#harga_tanpa_ppn").text(totalHargaTanpaTaxes.toFixed(2));

        // Update tampilan
        $("#harga_keseluruhan").text(grandTotal.toFixed(2));
        $("#harga_keseluruhan_hide").val(grandTotal.toFixed(2));
    }



    function hitung() {
        var quantity = $('#quantity').val();
        var hargaNet = $('#hargaNet').val();
        var hargaTotal = quantity * hargaNet;
        $('#hargaTotal').val(hargaTotal);
    }

    // Fungsi untuk menghapus baris
    function hapuslist(button) {
        let row = button.closest("tr");
        row.remove();
        updateRowNumbers();

        // Update grand total setelah menghapus item
        updateGrandTotal();
    }

    // Fungsi untuk memindahkan baris ke atas
    function moveUp(button) {
        let row = button.closest("tr");
        let prevRow = row.previousElementSibling;

        if (prevRow) {
            row.parentNode.insertBefore(row, prevRow);
            updateRowNumbers();
        }
    }

    // Fungsi untuk memindahkan baris ke bawah
    function moveDown(button) {
        let row = button.closest("tr");
        let nextRow = row.nextElementSibling;

        if (nextRow) {
            row.parentNode.insertBefore(nextRow, row);
            updateRowNumbers();
        }
    }

    // Fungsi untuk memperbarui nomor urutan setelah perubahan posisi
    function updateRowNumbers() {
        let rows = document.querySelectorAll("#tbody tr");
        rows.forEach((row, index) => {
            row.cells[0].textContent = index + 1;
        });
    }

    function saveAll() {

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
        // Tambahkan token CSRF
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
        // postdata.append('user_code', document.getElementById('user_code').value); 
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
        postdata.append('permintaan_stock_name', "Gudang Semarang"); 
        postdata.append('permintaan_spesifikasi', document.getElementById('permintaan_spesifikasi').value); 
        postdata.append('keterangan', getEditorValue()); 
        postdata.append('harga_total', document.getElementById('harga_keseluruhan_hide').value);
        postdata.append('harga_ppn', document.getElementById('harga_ppn').value);
        postdata.append('harga_tanpa_ppn', document.getElementById('harga_tanpa_ppn').value);
        postdata.append('kategori', datakategori);
        postdata.append('nomor_left', datakategori[0]);

        // console.log("datakategori",datakategori[0]);
        // return;

        // ambil detail
        var tbody = document.getElementById('tbody');
        var rows = tbody.getElementsByTagName('tr');

        var details = [];

        for (var i = 0; i < rows.length; i++) {
            var cells = rows[i].getElementsByTagName('td');

            var detail = {
                no: cells[0].innerText.trim(),
                produk_code: cells[1].innerText.trim(),
                produk_name: cells[2].innerText.trim(),
                qty: cells[3].querySelector('input').value.trim(),
                stock: cells[4].innerText.trim(),
                status: cells[5].innerText.trim(),
                status_name: cells[6].innerText.trim(),
                satuan: cells[7].innerText.trim(),
                harga_unit: cells[8].innerText.trim(),
                harga_net: cells[9].innerText.trim(),
                taxes: cells[10].querySelector("select").value.trim(),
                harga_total: cells[11].innerText.trim()
            };

            details.push(detail);
        }

        // Tambahkan detail ke FormData sebagai JSON string
        postdata.append('details', JSON.stringify(details));

        // console.log('Data FormData: ', Array.from(postdata.entries()));

        // return;

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

    async function previewpdf() {

        // console.log("data");
        

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
        // Tambahkan token CSRF
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
        postdata.append('permintaan_stock_name', "Gudang Semarang"); 
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

            var detail = {
                no: cells[0].innerText.trim(),
                produk_code: cells[1].innerText.trim(),
                produk_name: cells[2].innerText.trim(),
                qty: cells[3].querySelector('input').value.trim(),
                stock: cells[4].innerText.trim(),
                status: cells[5].innerText.trim(),
                status_name: cells[6].innerText.trim(),
                satuan: cells[7].innerText.trim(),
                harga_unit: cells[8].innerText.trim(),
                harga_net: cells[9].innerText.trim(),
                taxes: cells[10].querySelector("select").value.trim(),
                harga_total: cells[11].innerText.trim()
            };

            details.push(detail);
        }

        postdata.append('details', JSON.stringify(details));

        // console.log('Data FormData: ', Array.from(postdata.entries()));

        // let iframe = document.getElementById('iframePreview');
        // iframe.setAttribute("src", "inquiry_supply_only/previewpdf");
        // $('#modalpreview').modal('show');

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
            $('.pph-input-data').css('display','none');
            $('#header_form_nama').addClass('hidden');
            $('#header_form_permintaan').addClass('hidden');
            $('#modalpreview').modal('show');
        } catch (error) {
            console.error('Error:', error);
            Swal.fire('Error', 'Gagal memuat preview PDF', 'error');
        }

    }

    function showppn() {
        $('.pph-input-data').css('display','block');
        $('#header_form_nama').removeClass('hidden');
        $('#header_form_permintaan').removeClass('hidden');
    }
</script>

@endsection

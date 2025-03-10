@extends('backend.layouts.master')

@section('title')
Inquiry - Admin Panel
@endsection

@php
    $usr = Auth::guard('web')->user();
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
                            <div class="fromGroup horizontal-form mb-3">
                                <label><b>Nama</b></label>
                                <!-- <input class="form-control" type="text" placeholder="Pilih Nama"> -->
                                <select class="form-control" id="nama_customer" style="width: 100%;">
                                    <option value="" disabled selected>Pilih Nama</option>
                                </select>
                            </div>
                            <div class="fromGroup horizontal-form mb-3">
                                <label><b>User</b></label>
                                <!-- <input class="form-control" id="user_code" type="text" placeholder="Pilih Customer Dulu"> -->
                                <div class="select-box">
                                    <select class="custom-select sources" id="user_code" title="User">
                                        <option value="1">Reseller</option>
                                        <option value="2">End User</option>
                                        <option value="3">Kontraktor</option>
                                    </select>
                                </div>
                            </div>
                            <div class="fromGroup horizontal-form mb-3">
                                <label><b>Perusahaan</b></label>
                                <input class="form-control" type="text" id="company">
                            </div>
                            <div class="fromGroup horizontal-form mb-3">
                                <label><b>Alamat</b></label>
                                <input class="form-control" type="text" id="address">
                            </div>
                            <div class="fromGroup horizontal-form mb-3">
                                <label><b>Prov & Kota</b></label>
                                <input class="form-control" type="text" id="city">
                            </div>
                            <div class="fromGroup horizontal-form mb-3">
                                <label><b>No. Tlpn</b></label>
                                <input class="form-control" type="text" id="phone">
                            </div>
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
                            <div class="fromGroup horizontal-form mb-3">
                                <label><b>Dari</b></label>
                                <input class="form-control" type="text"> 
                            </div>
                            <div class="fromGroup horizontal-form mb-3">
                                <label><b>Lokasi</b></label>
                                <input class="form-control" type="text">
                            </div>
                            <div class="fromGroup horizontal-form mb-3">
                                <label><b>Pengiriman</b></label>
                                <input class="form-control" type="text">
                            </div>
                            <div class="fromGroup horizontal-form mb-3">
                                <label><b>Ongkir</b></label>
                                <input class="form-control" type="text">
                            </div>
                            <div class="fromGroup horizontal-form mb-3">
                                <label><b>Kategori</b></label>
                                <input class="form-control" type="text">
                            </div>
                            <div class="fromGroup horizontal-form mb-3">
                                <label><b>Stock</b></label>
                                <input class="form-control" type="text">
                            </div>
                            <div class="fromGroup horizontal-form mb-3">
                                <label><b>Spesifikasi</b></label>
                                <input class="form-control" type="text">
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
                                <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#modalinput" style="color: #2563eb;"><i class="ph ph-plus"></i> Tambah Data</button>
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
                                <textarea id="editor" name="content" class="form-control"></textarea>
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
        Harga Total : 0 <span class="harga-invalid">(Harga belum valid)</span><br>
        <small>* Termasuk PPN 11% dan ongkir</small>
    </div>
    <div class="button-container">
        <button type="button" class="btn btn-warning"><i class="ph ph-eye" style="font-size: 20px;"></i> Pratinjau</button>
        <button type="button" class="btn btn-primary"><i class="ph ph-floppy-disk" style="font-size: 20px;"></i> Simpan</button>
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
                        <div id=namaBarangCombo>
                            <select class="form-control" id="namaBarang" style="width: 100%;">
                                <option value="" disabled selected>Pilih Barang</option>
                            </select>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity" value="" onchange="hitung()">
                        </div>
                        <div class="col-md-6">
                            <label for="satuan" class="form-label">Satuan</label>
                            <input type="text" class="form-control" id="satuan" value="" readonly>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="hargaPricelist" class="form-label">Harga pricelist</label>
                            <input type="text" class="form-control" id="hargaPricelist" value="" onchange="hitung()" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="hargaNet" class="form-label">Harga NET (End user)</label>
                            <input type="text" class="form-control" id="hargaNet" value="" readonly>
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

<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .then(editor => {
            // editor.setData(`{!! old('content', $post->content ?? '') !!}`); // contoh value ambil dari dabaase
            editor.setData(`
                1. Harga sudah termasuk PPN 11%. <br>
                2. Pembayaran Melalui Cheque / Giro Atas Nama : PT. Patigeni Mitra Sejati dianggap lunas setelah Cheque / Giro dicairkan. Pembayaran melalui Transfer hanya melalui rekening 
                BCA AN PT. Patigeni Mitra Sejati BCA Ungaran a/c IDR : 222068B111 Bank Mandiri Pemuda a/c : 1350078787577 Kami tidak bertanggung jawab atas transaksi diluar akun tersebut. <br>
                3. Stock : Mohon konfirmasi sales. <br>
                4. Franco : Jakarta, Semarang, Surabaya. <br>
                5. Pembayaran : Cash Before Delivery. <br>
                6. Validasi penawaran : 7 hari kerja. <br>
                7. Harga tidak termasuk jasa instalasi (Supply Only). <br>
                8. Barang yang sudah dibeli tidak dapat ditukar / dikembalikan. <br>
                9. Email resmi perusahaan adalah email yang menggunakan domain @patigeni.com diluar akun tersebut dianggap tidak SAH. <br>
            `);
        })
        .catch(error => {
            console.error(error);
        });

    $(document).ready(function() {        
        // $('#modalinput').on('shown.bs.modal', function () {
            $('#nama_customer').on('select2:select', function(e) {
                var data = e.params.data;
                // console.log(data);
                // $('#user_code').val(data.id);
                $('#company').val(data.text);
                $('#address').val(data.customers_full_address);
                $('#city').val(data.provinces_code+" & "+data.cities_code);
                $('#phone').val(data.customers_phone);
                $('#email').val(data.customers_email);
            }).on("select2:unselect", function (e) {
                // clear data
            }).select2({
                // dropdownParent: $('#modalinput'),
                placeholder: "Pilih Nama",
                allowClear: true,
                ajax: {
                    url: '/admin/combocustomer',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            search: params.term,
                            // data: $('#cities_code').val()
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
            
        // });

        $('#modalinput').on('shown.bs.modal', function () {
            $('#namaBarang').on('select2:select', function(e) {
                var data = e.params.data;
                // console.log(data);
                // $('#user_code').val(data.id);
                $('#satuan').val(data.uom_name);
                $('#hargaPricelist').val(data.goods_price);
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
                // $('#hargaTotal').val(data.id);
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
                            // data: $('#cities_code').val()
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

    });

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
            // $('#hargaTotal').removeAttr('readonly');
        }
    }

    function tambahlist() {

        $('#modalinput').modal('hide')

        $('#table_misi').removeClass('hidden');
        $('#new_misi').addClass('hidden');

        const checkreq = $('#requestProdukSwitch').prop('checked');
        if (checkreq == false) {
            var namaBarang = $('#namaBarang').val();
            var status = '<p style="color: green;">Ready</p>'; // indent
            var stok = 1;
        } else {
            var namaBarang = $('#namaBarangText').val();
            var status = '<p style="color: red;">Tidak ditemukan disistem</p>';
            var stok = 0;
        }
        var quantity = $('#quantity').val();
        var satuan = $('#satuan').val();
        var hargaPricelist = $('#hargaPricelist').val();
        var hargaTotal = $('#hargaTotal').val();
        var no = $('#tbody tr').length + 1;
        var hargaNet = $('#hargaNet').val();

        $('#tbody').append(`
            <tr>
                <td class="text-center">${no}</td>
                <td>${namaBarang}</td>
                <td><input type="number" value="${quantity}"></td>
                <td>${stok}</td>
                <td>${status}</td>
                <td>${satuan}</td>
                <td>${hargaPricelist}</td>
                <td>${hargaNet}</td>
                <td><input type="text" value="12%"></td>
                <td>${hargaTotal}</td>
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
    }

    function hitung() {
        var quantity = $('#quantity').val();
        var hargaNet = $('#hargaPricelist').val();
        var hargaTotal = quantity * hargaNet;
        $('#hargaTotal').val(hargaTotal);
    }

    // Fungsi untuk menghapus baris
    function hapuslist(button) {
        let row = button.closest("tr");
        row.remove();
        updateRowNumbers();
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
</script>

@endsection

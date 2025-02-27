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
                                <input class="form-control" type="text" placeholder="Pilih Nama"> <!-- Pilih Nama diambil dari data customer (search) -->
                            </div>
                            <div class="fromGroup horizontal-form mb-3">
                                <label><b>User</b></label>
                                <input class="form-control" type="text" placeholder="Pilih Customer Dulu">
                            </div>
                            <div class="fromGroup horizontal-form mb-3">
                                <label><b>Perusahaan</b></label>
                                <input class="form-control" type="text">
                            </div>
                            <div class="fromGroup horizontal-form mb-3">
                                <label><b>Alamat</b></label>
                                <input class="form-control" type="text">
                            </div>
                            <div class="fromGroup horizontal-form mb-3">
                                <label><b>Prov & Kota</b></label>
                                <input class="form-control" type="text">
                            </div>
                            <div class="fromGroup horizontal-form mb-3">
                                <label><b>No. Tlpn</b></label>
                                <input class="form-control" type="text">
                            </div>
                            <div class="fromGroup horizontal-form mb-3">
                                <label><b>Email</b></label>
                                <input class="form-control" type="text">
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
                                <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#modalinput" onclick="clearform()"><i class="ph ph-plus"></i> Tambah Data</button>
                            </div>
                        </div>

                        <div class="card-body">
                                    
                            <div style="border: 1px solid #d1d5db; border-radius: 8px; padding: 12px; display: flex; align-items: center; background-color: #f9fafb;">
                                <div style="color: #2563eb; font-size: 45px; margin-right: 10px;">ℹ️</div>
                                <div>
                                    <strong>Mulai Misi Baru! 🎉</strong><br>
                                    <span>Misi: Tambahkan barang sesuai kebutuhan customer. Reward: Kepuasan pelanggan meningkat!</span>
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
</script>

@endsection

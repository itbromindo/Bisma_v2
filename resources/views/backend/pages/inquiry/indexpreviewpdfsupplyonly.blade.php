<!DOCTYPE html>
@php
    $details = json_decode($data['data']['details'], true);
    $harga_sebelum_ppn = 0;
    $harga_ppn_per_barang = 0;
@endphp
<html>
<head>
    <meta charset="utf-8">
    <title>Penawaran Harga</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        /* .header { text-align: center; font-weight: bold; } */
        .table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .table, .table th, .table td { border: 1px solid black; padding: 5px; }
        .table th { background-color: #f2f2f2; }
        .right { text-align: right; }
        .bold { font-weight: bold; }

        @page {
            margin: 100px 50px; /* atur margin supaya header & footer nggak ketiban konten */
        }

        .header {
            position: fixed;
            top: -80px; /* sesuaikan dengan tinggi header */
            left: 0;
            right: 0;
            text-align: center;
        }

        .footer {
            position: fixed;
            bottom: -50px; /* sesuaikan dengan tinggi footer */
            left: 0;
            right: 0;
            text-align: center;
        }

        .content {
            margin-top: 20px;
        }

        img {
            width: 100%; /* agar gambar menyesuaikan lebar halaman */
            height: auto;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="file://{{ public_path('images/header-bmm-2024.jpg') }}" alt="Header">
    </div>

    <div class="footer">
        <img src="file://{{ public_path('images/footer-bromindo-26th.png') }}" alt="Footer">
    </div>

    <div class="content">
        <table width="100%" style="margin-bottom: 20px;">
            <tr>
                <td width="70%">
                    <table>
                        <tr>
                            <td><strong>No</strong></td>
                            <td>: {{ $data['code_header'] ?? '-'}}</td>
                        </tr>
                        <tr>
                            <td><strong>Hal</strong></td>
                            <td>: Penawaran Harga</td>
                        </tr>
                    </table>
                </td>
                <td width="30%" style="text-align: right;">
                    {{ $data['data']['permintaan_lokasi'] ?? '-'}}
                </td>
            </tr>
        </table>

        <p>Kepada Yth.<br>
            <strong>{{ $data['data']['company'] ?? '-' }}</strong><br>
            {{ $data['data']['address'] ?? '-'}}, Telp: {{ $data['data']['phone'] ?? '-'}}<br>
            Email: {{ $data['data']['email'] ?? '-'}}<br>
            Attn: {{ $data['data']['phone'] ?? '-'}}
        </p>
    
        <p>Dengan Hormat,</p>
        <p>Bersama dengan ini kami sampaikan penawaran harga barang sebagai berikut:</p>
    
        <table class="table">
            <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Uraian</th>
                    <th rowspan="2">Qty</th>
                    <th rowspan="2">Sat</th>
                    <th rowspan="2">Harga Unit (Rp)</th>
                    <th colspan="2">Diskon</th>
                    <th rowspan="2">Harga Setelah Diskon</th>
                    <th rowspan="2">Jumlah</th>
                </tr>
                <tr>
                    <th>%</th>
                    <th>Nominal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($details as $d)
                    @php
                        if($d['status'] == '3'){
                            $status = '(indent)';
                        }else{
                            $status = '';
                        }
                    @endphp
                    <tr>
                        <td>{{ $d['no'] ?? '0' }}</td>
                        <td>{{ $d['produk_name'] ?? '' }} {{$status}}</td>
                        <td class="center">{{ $d['qty'] ?? '' }}</td>
                        <td>{{ $d['satuan'] ?? '' }}</td>
                        <td class="right">{{ number_format($d['harga_net'],0) ?? '' }}</td>
                        <td class="right">0</td>
                        <td class="right">0</td>
                        <td class="right">0</td>
                        <td class="right">{{ number_format($d['qty']*$d['harga_net'],0) }}</td>
                    </tr>
                    @php
                        $harga_sebelum_ppn += $d['qty']*$d['harga_net'];
                        $harga_ppn_per_barang += $d['qty']*$d['harga_net'] * ($d['taxes'] / 100);
                    @endphp
                @endforeach

                @php
                    $harga_ppn = $harga_ppn_per_barang;
                    $harga_akhir = $data['data']['harga_total'];
                @endphp

                <tr>
                    <td colspan="8" class="right">Harga Sebelum PPN:</td>
                    <td class="right">{{ number_format($harga_sebelum_ppn,0) ?? '0' }}</td>
                </tr>
                <tr>
                    <td colspan="8" class="right">Ongkir:</td>
                    <td class="right">{{ number_format($data['data']['permintaan_ongkir'],0) ?? '0' }}</td>
                </tr>
                <tr>
                    <td colspan="8" class="right">PPN:</td>
                    <td class="right">{{ number_format($harga_ppn,0) ?? '0' }}</td>
                </tr>
                <tr>
                    <td colspan="8" class="right"><b>Total:</b></td>
                    <td class="right"><b>{{ number_format($harga_akhir,0) ?? '0' }}</b></td>
                </tr>
            </tbody>
        </table>
    
        <!-- <p>
            GRATIS* <br>
            <br>
            Manage Alat Pemadam Api dengan Aplikasi FireCek - Info Detail<br>
            1. Easy Check Anytime Anywhere<br>
            2. Expired Notification<br>
            3. Fire Analysis<br>
            4. Inventory Control<br>
            5. Cost Estimation<br>
        </p> -->
    
        <p>Syarat & Ketentuan:
            <br>
            {!! $data['data']['keterangan'] ?? '-' !!}
            <br>
        </p>

        <!-- <p>
            EMAIL PERUSAHAAN YANG BERLAKU ADALAH ALAMAT EMAIL YANG MENGGUNAKAN AKUN RESMI PERUSAHAAN<br>
            CONTOH : XXX@BROMINDO.COM<br>
            DILUAR AKUN RESMI PERUSAHAAN EMAIL DIANGGAP TIDAK SAH<br>
        </p>

        <p>
            Layanan Purna Jual Alat Pemadam Api :<br>
            1. Pelayanan pengisian ulang APAR dilakukan ditempat ( kecuali Media CO2 )<br>
            2. Garansi kebocoran tabung selama 5 (lima) tahun untuk media HFC-227, CO2, media powder, dan 2 (dua) tahun untuk foam, selama segel masih dalam keadaan utuh.<br>
            <br>
            Demikian surat penawaran ini dari kami, atas perhatian dan kerjasamanya kami mengucapkan terima kasih.<br>
            <br>
            Hormat kami,<br>
            <br>
            <br>
            <br>
            <b>Dhevia</b><br>
            08882420888<br>
        </p> -->
    </div>
    
</body>
</html>

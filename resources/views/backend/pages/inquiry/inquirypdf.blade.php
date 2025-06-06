<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Penawaran Harga</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
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

    @php
        $homebase = session()->get('homebase_name');
    @endphp

    <div class="content">
        <table width="100%" style="margin-bottom: 20px;">
            <tr>
                <td width="70%">
                    <table>
                        <tr>
                            <td><strong>No</strong></td>
                            <td>: {{ $data['inquiry']->inquiry_code ?? '-'}}</td>
                        </tr>
                        <tr>
                            <td><strong>Hal</strong></td>
                            <td>: Penawaran Harga</td>
                        </tr>
                    </table>
                </td>
                <td width="30%" style="text-align: right;">
                    {{ $homebase }}, {{ date_format_indonesia(date('Y-m-d', strtotime($data['inquiry']->inquiry_created_at))) }}
                </td>
            </tr>
        </table>

        <p>Kepada Yth.<br>
            <strong>{{ $data['inquiry']->customer_name ?? '-' }}</strong><br>
            {{ $data['inquiry']->customers_full_address ?? '-'}}, Telp: {{ $data['inquiry']->customers_phone ?? '-'}}<br>
            Email: {{ $data['inquiry']->customers_email ?? '-'}}<br>
            Attn: {{ $data['inquiry']->customers_phone ?? '-'}}
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
                @php 
                    $no = 1; 
                    $harga_sebelum_ppn = 0; 
                    $harga_ppn_per_barang = 0;
                    $total_harga = 0; 
                @endphp
                @foreach($data['details'] as $d)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $d->inquiry_product_name ?? '' }}</td>
                    <td class="center">{{ $d->inquiry_product_qty ?? '' }}</td>
                    <td>{{ $d->uom_name ?? '' }}</td>
                    <td class="right">{{ number_format($d->inquiry_product_net_price,0) ?? '' }}</td>
                    <td class="right">0</td>
                    <td class="right">0</td>
                    <td class="right">0</td>
                    <td class="right">{{ number_format($d->inquiry_product_qty * $d->inquiry_product_net_price,0) }}</td>
                </tr>
                @php
                    $harga_sebelum_ppn += $d->inquiry_product_qty*$d->inquiry_product_net_price;
                    $harga_ppn_per_barang += $d->inquiry_product_qty*$d->inquiry_product_net_price * ($d->inquiry_taxes_percent / 100);
                    $total_harga += $d->inquiry_product_total_price;
                @endphp
                @endforeach

                @php
                    $harga_ppn = $harga_ppn_per_barang;
                    $harga_akhir = $total_harga;
                @endphp

                <tr>
                    <td colspan="8" class="right">Harga Sebelum PPN:</td>
                    <td class="right">{{ number_format($harga_sebelum_ppn,0) ?? '0' }}</td>
                </tr>
                <tr>
                    <td colspan="8" class="right">Ongkir:</td>
                    <td class="right">{{ number_format($data['inquiry']->inquiry_shipping_cost,0) ?? '0' }}</td>
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

        <p>Syarat & Ketentuan:
            <br>
            {!! $data['inquiry']->inquiry_notes ?? '-' !!}
            <br>
        </p>

    </div>
    
</body>
</html>

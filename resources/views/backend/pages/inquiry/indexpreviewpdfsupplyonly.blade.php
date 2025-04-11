<!DOCTYPE html>
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
        <p>Kepada Yth.<br>
        <strong>{{ $data['company'] ?? '-' }}</strong><br>
        {{ $data['address'] ?? '-'}}, Telp: {{ $data['phone'] ?? '-'}}<br>
        Email: {{ $data['email'] ?? '-'}}<br>
        Attn: {{ $data['phone'] ?? '-'}}
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
                <tr>
                    <td>1</td>
                    <td>Refilling SP Powder Kap. 3 Kg</td>
                    <td class="right">37</td>
                    <td>pcs</td>
                    <td class="right">89.950,00</td>
                    <td class="right">10%</td>
                    <td class="right">8.995,00</td>
                    <td class="right">80.955,00</td>
                    <td class="right">2.996.350,00</td>
                </tr>
                <tr>
                    <td colspan="8" class="right">Harga Sebelum PPN:</td>
                    <td class="right">1</td>
                </tr>
                <tr>
                    <td colspan="8" class="right">Ongkir:</td>
                    <td class="right">2</td>
                </tr>
                <tr>
                    <td colspan="8" class="right">PPN:</td>
                    <td class="right">3</td>
                </tr>
                <tr>
                    <td colspan="8" class="right">Total:</td>
                    <td class="right">4</td>
                </tr>
            </tbody>
        </table>
    
        <p>
            GRATIS* <br>
            <br>
            Manage Alat Pemadam Api dengan Aplikasi FireCek - Info Detail<br>
            1. Easy Check Anytime Anywhere<br>
            2. Expired Notification<br>
            3. Fire Analysis<br>
            4. Inventory Control<br>
            5. Cost Estimation<br>
        </p>
    
        <p>Syarat & Ketentuan:
            <br>
        </p>
    </div>
    
</body>
</html>

<?php

namespace App\Imports;

use App\Models\Penduduk;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PendudukImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $image = "data:image/svg+xml;base64,PHN2ZyBoZWlnaHQ9IjEwMCIgd2lkdGg9IjEwMCIgdmlld0JveD0iMCAwIDUwIDUwIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHN0eWxlPSJmaWxsOiMwMDAwMDA7Ij4KICAgIDxjaXJjbGUgY3g9IjI1IiBjeT0iMTEiIHI9IjkiLz4KICAgIDxwYXRoIGQ9Ik0yNSAyMUMxNi4yIDIxIDkgMjguMiA5IDM3djcuNmMwIC41LjQuOSA5IDkuN2wzLjUgM2MuOS43IDEuNiAxLjEgMy41IDEuMWgxMC4zYzEuOSAwIDIuNi0uNCAzLjUtMS4xbDMuNS0zYzguNy0uOCA5LjMtNC40IDktOS43VjM3YzAtOC44LTcuMi0xNi0xNi0xNnoiLz4KPC9zdmc+Cg==";
        return new Penduduk([
            'penNik' => $row['pen_nik'],
            'penNama' => $row['pen_nama'],
            'penTempatLahir' => $row['pen_tempat_lahir'],
            'penTglLahir' => $this->convertDate($row['pen_tgl_lahir']),
            'penImage' => $row['pen_image'] ?? $image,
        ]);
    }

    private function convertDate($date)
    {
        // Periksa apakah format sudah benar (YYYY/MM/DD)
        if (preg_match('/^\d{4}\/\d{2}\/\d{2}$/', $date)) {
            return $date;
        }

        // Konversi dari format MM/DD/YYYY ke YYYY/MM/DD
        $dateTime = \DateTime::createFromFormat('m/d/Y', $date);
        if ($dateTime) {
            return $dateTime->format('Y/m/d');
        }

        // Jika format tidak dikenali, kembalikan tanggal asli atau null
        return null;
    }
}

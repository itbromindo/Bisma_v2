<?php

namespace App\Exports;

use App\Models\Penduduk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PendudukExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Penduduk::all();
    }

    public function headings(): array
    {
        return [
            'pen_nik',
            'pen_nama',
            'pen_tempat_lahir',
            'pen_tgl_lahir',
            'pen_image',
        ];
    }
}

<?php

namespace App\Exports;

use App\Models\LaporanKeuangan;
use Maatwebsite\Excel\Concerns\FromCollection;
// use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanKeuanganExport implements FromCollection, WithHeadings
{
    public function Collection()
    {
        return LaporanKeuangan::select(
            'staf', 
            'jenis_dipa', 
            'program_kegiatan', 
            'dipa_kegiatan', 
            'uraian_kegiatan', 
            'volume', 
            'harga_satuan', 
            'pagu', 
            'realisasi', 
            // 'sisa_anggaran'
        )->get();
    }

    public function headings(): array{
        return [
            "STAF", 
            "JENIS DIPA", 
            "PROGRAM KEGIATAN", 
            "KEGIATAN",
            "SUB KEGIATAN",
            "VOLUME",
            "HARGA SATUAN",
            "PAGU",
            "REALISASI",
            // "SISA ANGGARAN"
        ];
    }
}

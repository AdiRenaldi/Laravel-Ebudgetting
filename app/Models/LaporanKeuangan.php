<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanKeuangan extends Model
{
    use HasFactory;

    protected $table = 'laporan_keuangan';
    protected $fillable =[
        'staf_id',
        'dipa_id',
        'staf',
        'program_kegiatan',
        'jenis_dipa',
        'dipa_kegiatan',
        'kegiatan_kode',
        'uraian_kegiatan',
        'volume',
        'list',
        'harga_satuan',
        'pagu',
        'realisasi',
        'sisa_anggaran',
        'tanggal',
        'bulan',
        'tahun',
    ];

    public function staf()
    {
        return $this->belongsTo(Staf::class, 'staf_id', 'id');
    }

    public function dipa()
    {
        return $this->belongsTo(Dipa::class, 'dipa_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Model;
use Cviebrock\EloquentSluggable\Sluggable;

class RealisasiAnggaran extends Model
{
    use HasFactory;
    use Sluggable;

    protected $table = 'realisasi_anggaran';
    protected $fillable =[
        'staf_id', 
        'program_kegiatan', 
        'staf', 
        'bidang', 
        'jenis_dipa', 
        'dipa_kegiatan', 
        'kode_kegiatan', 
        'uraian_kegiatan', 
        'slug', 
        'volume', 
        'list',
        'harga_satuan',
        'pagu',
        'spn',
        'realisasi',
        // 'total',
        // 'sisa_anggaran',
        'notifikasi',
        'tanggal',
        'bulan',
        'tahun',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'uraian_kegiatan'
            ]
        ];
    }
}

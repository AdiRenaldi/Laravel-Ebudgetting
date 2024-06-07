<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Foundation\Auth\User as Model;

class KebutuhanAnggaran extends Model
{
    use HasFactory;
    use Sluggable;

    protected $table = 'kebutuhan_anggaran';
    protected $fillable =[
        'jenis_dipa',
        'program_kode',
        'dipa_kode',
        'dipa_id',
        'staf_id',
        'kode',
        'uraiaan',
        'volume',
        'harga_satuan',
        'list',
        'pagu',
        'notifikasi',
        'tanggal',
        'bulan',
        'tahun',
        'status',
        'respon',
        'revisi',
        'catatan'
    ];

    // protected $attributes = [
    //     'staf_id' => Auth::id(),
    // ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'uraiaan'
            ]
        ];
    }

    // public function role()
    // {
    //     return $this->belongsTo(Role::class, 'role_id', 'id');
    // }

    public function staf()
    {
        return $this->belongsTo(Staf::class, 'staf_id', 'id');
    }
}

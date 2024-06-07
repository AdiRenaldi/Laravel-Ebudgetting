<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class staf_anggaran extends Model
{
    use HasFactory;

    protected $table = 'staf_anggaran';
    protected $fillable =[
        'dipa_id', 
        'staf_id', 
        'jenis_dipa', 
        'staf_id', 
        'total_anggaran', 
        'penambahan_dana', 
        'pengurangan_dana', 
        'total_pemakaian', 
        'sisa_anggaran', 
        'notifikasi', 
        'tanggal', 
        'bulan', 
        'tahun'
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

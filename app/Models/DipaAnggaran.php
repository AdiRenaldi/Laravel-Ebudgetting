<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Foundation\Auth\User as Model;

class DipaAnggaran extends Model
{
    use HasFactory;
    use Sluggable;
    
    protected $table = 'dipa_anggaran';
    protected $fillable =[
        'jenis_dipa', 'anggaran', 'penambahan_dana', 'pengurangan_dana', 'total_digunakan', 'sisa_anggaran', 'tanggal', 'bulan', 'tahun'
    ];

    // protected $attributes = [
    //     'role_id' => 2,
    // ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'jenis_dipa'
            ]
        ];
    }

    // public function role()
    // {
    //     return $this->belongsTo(Role::class, 'role_id', 'id');
    // }
}

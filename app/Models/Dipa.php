<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Foundation\Auth\User as Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Dipa extends Model
{
    use HasFactory;
    use Sluggable;

    protected $table = 'dipa';
    protected $fillable =[
        'jenis_dipa', 
        'anggaran',
        'penambahan_dana',
        'pengurangan_dana',
        'anggaran_baru',
        'total_digunakan', 
        'sisa_anggaran', 
        'status', 
        'respon', 
        'revisi', 
        'spn',
        'tanggal', 
        'bulan', 
        'tahun',
    ];


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'jenis_dipa'
            ]
        ];
    }

    public function catrgoriesKegiatan():BelongsToMany
    {
        return $this->belongsToMany(DipaKegiatan::class, 'kategory_kegiatan', 'dipa_id', 'kegiatan_id');
    }

    public function categoriesProgram():BelongsToMany
    {
        return $this->belongsToMany(ProgramKegiatan::class, 'kategory_program', 'dipa_id', 'program_id');
    }

    /**
     * Get the user associated with the Dipa
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function RevisiDipa()
    {
        return $this->hasOne(RevisiDipa::class, 'dipa_id', 'id');
    }

    public function RevisiStaf()
    {
        return $this->hasOne(RevisiStaf::class, 'staf_id', 'id');
    }
}

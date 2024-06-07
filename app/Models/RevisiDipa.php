<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RevisiDipa extends Model
{
    use HasFactory;
    protected $table = 'revisi_dana';
    protected $fillable =[
        'dipa_id',
        'dana_awal',
        'penambahan_dana',
        'pengurangan_dana',
        'dana_sekarang',
        'tanggal', 
        'bulan', 
        'tahun',
    ];

    /**
     * Get the user that owns the RevisiDipa
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dipa()
    {
        return $this->belongsTo(Dipa::class, 'dipa_id', 'id');
    }

    // public function staf()
    // {
    //     return $this->belongsTo(Staf::class, 'staf_id', 'id');
    // }
}

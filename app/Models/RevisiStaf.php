<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RevisiStaf extends Model
{
    use HasFactory;
    protected $table = 'revisi_dana_staf';
    protected $fillable =[
        'staf_id',
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
    public function staf()
    {
        return $this->belongsTo(Staf::class, 'staf_id', 'id');
    }

    public function dipa()
    {
        return $this->belongsTo(Dipa::class, 'dipa_id', 'id');
    }
}

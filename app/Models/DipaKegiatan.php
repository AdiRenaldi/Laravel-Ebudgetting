<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Foundation\Auth\User as Model;

class DipaKegiatan extends Model
{
    use HasFactory;
    use Sluggable;
    
    protected $table = 'dipa_kegiatan';
    protected $fillable =[
        'kode', 'kegiatan',
    ];

    // protected $attributes = [
    //     'role_id' => 2,
    // ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'kegiatan'
            ]
        ];
    }

    // public function role()
    // {
    //     return $this->belongsTo(Role::class, 'role_id', 'id');
    // }
}
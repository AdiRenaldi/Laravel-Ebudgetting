<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Model;

class ProgramKegiatan extends Model
{
    use HasFactory;
    use Sluggable;
    
    protected $table = 'program_kegiatan';
    protected $fillable =[
        'kode', 'program_kegiatan',
    ];

    // protected $attributes = [
    //     'role_id' => 2,
    // ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'program_kegiatan'
            ]
        ];
    }
    
}

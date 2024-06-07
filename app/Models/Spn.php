<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Spn extends Model
{
    use HasFactory;
    use Sluggable;

    protected $table = 'kepala_spn';

    protected $fillable =[
        'username', 'password', 'nama', 'slug', 'pangkat', 'nrp', 'telpon', 'email', 'role_id'
    ];

    protected $attributes = [
        'role_id' => 4,
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama'
            ]
        ];
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }
}

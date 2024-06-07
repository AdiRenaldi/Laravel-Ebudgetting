<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Model;

class Renmi extends Model
{
    use HasFactory;
    use Sluggable;

    protected $table = 'renmi';
    protected $fillable =[
        'username', 'password', 'nama', 'slug', 'pangkat', 'nrp', 'telpon', 'email', 'role_id'
    ];

    protected $attributes = [
        'role_id' => 2,
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

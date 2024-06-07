<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Model;

class Staf extends Model
{
    use HasFactory;
    use Sluggable;

    protected $table = 'staf';
    protected $fillable =[
        'username',
        'password', 
        'bidang',
        'nama', 
        'slug', 
        'pangkat', 
        'nrp', 
        'telpon', 
        'email', 
        'role_id', 
    ];

    protected $attributes = [
        'role_id' => 3,
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

    public function Kebutuhan_anggaran()
    {
        return $this->hasMany(KebutuhanAnggaran::class, 'id', 'staf_id');
    }

    public function RevisiStaf()
    {
        return $this->hasOne(RevisiStaf::class, 'staf_id', 'id');
    }

    public function RevisiDipa()
    {
        return $this->hasOne(RevisiDipa::class, 'dipa_id', 'id');
    }
}

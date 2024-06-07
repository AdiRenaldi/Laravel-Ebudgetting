<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';

    public function renmin()
    {
        return $this->hasMany(Renmi::class, 'role_id', 'id');
    }
}

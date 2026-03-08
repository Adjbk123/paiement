<?php

namespace App\Models;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
     protected $fillable = ['nom'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}

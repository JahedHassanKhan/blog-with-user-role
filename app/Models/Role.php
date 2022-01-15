<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function roleRoutes(){
        return $this->hasMany(RoleRoute::class, 'role_id');
    }
    public function users(){
        return $this->belongsToMany(User::class, 'user_roles');
    }
}

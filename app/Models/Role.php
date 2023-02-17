<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // fonction qui retourne la liste des utlisateurs avec le  role
    public function users()
    {
        return $this->belongsToMany(User::class)->using(RoleUser::class);
    }
}

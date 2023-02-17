<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_user', 'email','phrase_secrete', 'login','password','telephone','statut',
    ];
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    // Fonction qui retourne les roles d'un user par son id
    public function getRolesById($id){
        return $this->find($id)->roles()->orderBy('name')->get();
    }


    // Fonction qui determine si un utilisateur est un admin ou pas

    public function isAdmin(){
        foreach ($this->roles as $role) {
            if($role->type == 1){
                return true;
            }else{
                return false;
            }
        }
    }

    public function isLevelTwo()
    {
        # code...
        foreach ($this->roles as $role) {
            if($role->type == 2){
                return true;
            }else{
                return false;
            }
        }
    }

    public function isTeacher()
    {
        foreach ($this->roles as $role) {
            if($role->type == 3){
                return true;
            }else{
                return false;
            }
        }
    }


    public function isSurveillant()
    {
        foreach ($this->roles as $role) {
            if($role->nom_role  == "Surveillant"){
                return true;
            }else{
                return false;
            }
        }
    }

}

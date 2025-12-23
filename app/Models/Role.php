<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function user(){
        return $this->Hasmany(User::class); //Quan hệ 1 - N
    }

    public function permissions(){
        return $this->belongsToMany(Permission::class, 'role_permissions'); //Quan hệ N - N
    }
}

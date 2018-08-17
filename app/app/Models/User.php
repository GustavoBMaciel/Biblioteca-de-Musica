<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['id','name','imagem','email','permissao', 'password'];

    protected $hidden = [
        'password', 'remember_token',
    ];
}

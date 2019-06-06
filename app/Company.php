<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['name','id_user','email','phone'];

    public function users()
    {
        return $this->hasMany(User::class,'id','id_user');
    }

    
}

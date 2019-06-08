<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company_worker extends Model
{
   protected $attributes = [
    	'confirmed' => false
    ];

    public function users()
    {
        return $this->hasMany(User::class,'id','id_user');
    }

    public function companies()
    {
        return $this->hasMany(Company::class,'id','id_company');
    }
}

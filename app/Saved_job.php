<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Saved_job extends Model
{
    protected $fillable = ['id_user','id_job'];

    public function cities()
    {
    	return $this->hasMany(City::class,'id','id_city');
    }

    public function companies()
    {
        return $this->hasMany(Company::class,'id','id_company');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    //
    protected $fillable = ['name','id_user','id_category','id_city','id_contract','rate_min','rate_max','description'];

    protected $attributes = [
    	'rate_min' => '',
        'rate_max' => ''
    ];

    public function categories()
    {
    	return $this->hasMany(Category::class,'id','id_category');
    }

    public function cities()
    {
    	return $this->hasMany(City::class,'id','id_city');
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class,'id','id_contract');
    }

    public function users()
    {
        return $this->hasMany(User::class,'id','id_user');
    }

    public function companies()
    {
        return $this->hasMany(Company::class,'id','id_company');
    }
}

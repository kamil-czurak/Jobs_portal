<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $table = 'categories';

    protected $fillable = ['name'];


    public function job()
    {
    	return $this->belongsTo(Job::class);
    }
}

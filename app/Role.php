<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
    	'name',
    ];

    //Role Has Many Users
    public function users(){
        return $this->hasMany('App\User');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'id',
    	'name',
    	'description',
    	'user_id',
    ];

    //Company Belongs To User
    public function user(){
        return $this->belongsTo('App\User');
    }

    //Company Has Many Project
    public function projects(){
        return $this->hasMany('App\Project');
    }

    public function comments(){
        return $this->morphMany('App\Comment', 'commentable');
    }
}

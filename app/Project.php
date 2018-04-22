<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
    	'name',
    	'description',
        'project_nickname',
    	'company_id',
    	'user_id',
    	'days',
    ];

    //Project Belongs To User and Company
    public function users(){
        return $this->belongsTo('App\User');
    }

    public function company(){
        return $this->belongsTo('App\Company');
    }

    public function comments(){
        return $this->morphMany('App\Comment', 'commentable');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'id',
    	'name',
    	'description',
    	'project_id',
    	'company_id',
    	'user_id',
    	'days',
    	'points',
    	'is_closed',
    	'status',
    	'finished_at',
    ];

    //Task belongs to company and user, makanya diatas ada fillable untuk company_id dan user_id
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function project(){
        return $this->belongsTo('App\Project');
    }

    public function company(){
        return $this->belongsTo('App\Company');
    }

    public function comments(){
        return $this->morphMany('App\Comment', 'commentable');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $fillable = [
    	'name',
    	'user_id',
    	'month',
    	'year',
    	'q1',
    	'q2',
    	'q3',
    	'q4',
    	'q5',
    	'suggestion',
    ];

    //Task belongs to company and user, makanya diatas ada fillable untuk company_id dan user_id
    public function user(){
        return $this->belongsTo('App\User');
    }
}

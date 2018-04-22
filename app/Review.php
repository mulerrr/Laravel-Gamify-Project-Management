<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
    	'review',
    	'rating',
    	'user_id',
    ];

    //Task belongs to company and user, makanya diatas ada fillable untuk company_id dan user_id
    public function user(){
        return $this->belongsTo('App\User');
    }
}
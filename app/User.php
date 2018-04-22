<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'description',
        'position',
        'avatar',
        'username', 
        'status', 
        'email', 
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //SETUP TABLE RELATIONSHIP

    //Every user has many tasks
    // public function tasks(){
    //     return $this->hasMany('App\Task');
    // }

    //Every user belongs to  One Role = Makanya nama methodnya singular
    public function role(){
        return $this->belongsTo('App\Role');
    }

    //User has named Company -> PM bisa bertanggung jawab atas banyak perusahaan/client
    public function companies(){
        return $this->hasMany('App\Company');
    }

    //Many to Many Relationship
    public function tasks(){
        return $this->hasMany('App\Task');
    }

    //Many to Many Relationship
    public function presences(){
        return $this->hasMany('App\Presence');
    }

    //Many to Many Relationship
    public function projects(){
        return $this->hasMany('App\Project');
    }

    public function comments(){
        return $this->morphMany('App\Comment', 'commentable');
    }

    //Many to Many Relationship
    public function surveys(){
        return $this->hasMany('App\Survey');
    }

    //Many to Many Relationship
    public function testimonials(){
        return $this->hasMany('App\Survey');
    }


    public function getTask($user_id){
        return $user_id;
    }

}

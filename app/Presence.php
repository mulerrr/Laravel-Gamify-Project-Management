<?php

namespace App;

use App\Task;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{

    protected $fillable = [
    	'name',
    	'user_id',
    	'days',
        'max_days',
    	'month',
    	'year',
    ];

    //Task belongs to company and user, makanya diatas ada fillable untuk company_id dan user_id
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function lastMonthTaskSum($user_id)
    {   
        //initialize current date
        $date = \Carbon\Carbon::now();

        //variables for presence task points
        $fromDate = new Carbon('first day of last month');
        $toDate   = new Carbon('last day of last month');

        $tasks = Task::whereBetween('created_at', [ $fromDate, $toDate])->where('user_id', $user_id)->where('status', 'done')->get();

        //total poin yg didapat
        $totalPoints = $tasks->sum('points');

        return $totalPoints;
    }
    
}

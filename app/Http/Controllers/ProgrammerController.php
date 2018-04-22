<?php

namespace App\Http\Controllers;

use App\Survey;
use App\Task;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProgrammerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
    	//initialize current date
        $date = \Carbon\Carbon::now();

        $month      = $date->format('F');
        $year       = $date->format('Y');

        $user_id = Auth::user()->id;
        $surveyName = $month . $year . $user_id;

        $dataExist = Survey::where('name', $surveyName)->first();

        $tasksSummaries = Task::where('user_id', $user_id)->orderBy('updated_at', 'des')->get();

        if($dataExist){
            $showSurvey = 'show';
        } else {
            $showSurvey = 'hide';
        }
        
        //return view
        return view('homeProgrammer')->with(['showSurvey' => $showSurvey])
        ->with(['tasksSummaries' => $tasksSummaries]);
    }
}

<?php

namespace App\Http\Controllers;

use App\User;
use App\Presence;
use App\Company;
use App\Project;
use App\Review;
use App\Survey;
use App\Task;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class HomeController extends Controller
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

        if(Auth::user()->role_id == 2) {
            return redirect('/homeProgrammer');
        } else if (Auth::user()->role_id == 3) {
            return redirect('/home-client');
        }

        //presences graphic
        //Data for the graphics
        $imam = User::where('username', 'imamprastio')->first();
        $imamID = $imam->id;
        $cumi = User::where('username', 'cumibakar')->first();
        $cumiID = $cumi->id;

        $mulers = Presence::where('user_id', $imamID)->limit(6)->orderBy('id', 'desc')->get();
        $cumis = Presence::where('user_id', $cumiID)->limit(6)->orderBy('id', 'desc')->get();
        $months = $this->getMonthList();


        //initialize current date
        $date = \Carbon\Carbon::now();

        //variables for presence calculation
        $previousMonth = $date->subMonth()->format('F');
        $currentYear   = $date->format('Y');
        $presenceName  = $previousMonth . $currentYear;
        
        //variables for presence task points
        $fromDate = new Carbon('first day of last month');
        $toDate   = new Carbon('last day of last month');

        //date for survey
        $month      = $date->format('F');
        $year       = $date->format('Y');

        //all the objects to parse
        $totalEmployee = User::where('role_id', 2)->where('status', 'active')->count();
        $totalClient   = Company::all()->count();
        $totalProject  = Project::all()->count();
        $totalTask     = Task::all()->count();

        //check presence exist or not
        $checkPresence = Presence::where('name', $presenceName)->first();
        if ($checkPresence){
            $showPresence = 'show';
        } else {
            $showPresence = 'hide';
        }

        $presences      = Presence::all()->where('name', $presenceName);

        //SURVEY RESULT
        $surveyCount = Survey::where('month', $month)->where('year', $year)->count();
        $maxSurvey   = $surveyCount * 5;

        if($surveyCount == 0) {
            $maxSurvey = 1;
        }

        $q1 = Survey::where('month', $month)->where('year', $year)->sum('q1');
        $q2 = Survey::where('month', $month)->where('year', $year)->sum('q2');
        $q3 = Survey::where('month', $month)->where('year', $year)->sum('q3');
        $q4 = Survey::where('month', $month)->where('year', $year)->sum('q4');
        $q5 = Survey::where('month', $month)->where('year', $year)->sum('q5');

        $q1p = (int)(($q1 / $maxSurvey) * 100);
        $q2p = (int)(($q2 / $maxSurvey) * 100);
        $q3p = (int)(($q3 / $maxSurvey) * 100);
        $q4p = (int)(($q4 / $maxSurvey) * 100);
        $q5p = (int)(($q5 / $maxSurvey) * 100);

        //CLIENT'S REVIEWS
        $reviews = Review::all();

        $tasks          = Task::whereBetween('created_at', [ $fromDate, $toDate])->orderBy('user_id', 'asc')->get();

        $tasksSummaries = Task::orderBy('updated_at', 'des')->get();
        $users          = User::where('role_id', 2)->where('status', 'active')->orderBy('name', 'asc')->get();

        $cumiTasks = Task::where('user_id', 2)->get();

        $taskPercentage = self::taskCompletedPercentage();
        $guysMissing    = User::where('status', 'inactive')->where('role_id', 2)->count();

        //return view
        return view('home')->with(['presences' => $presences])->with(['tasks' => $tasks])->with(['tasksSummaries' => $tasksSummaries])->with(['users' => $users])
        ->with(['totalEmployee' => $totalEmployee])->with(['totalClient' => $totalClient])->with(['totalProject' => $totalProject])->with(['totalTask' => $totalTask])->with(['taskPercentage' => $taskPercentage])->with(['guysMissing' => $guysMissing])->with(['cumiTasks' => $cumiTasks])->with(['showPresence' => $showPresence])
        ->with(['mulers' => $mulers])->with(['cumis' => $cumis])->with(['months' => $months])
        ->with(['q1' => $q1])->with(['q2' => $q2])->with(['q3' => $q3])->with(['q4' => $q4])->with(['q5' => $q5])
        ->with(['q1p' => $q1p])->with(['q2p' => $q2p])->with(['q3p' => $q3p])->with(['q4p' => $q4p])->with(['q5p' => $q5p])->with(['reviews' => $reviews]);
    }



    public function getTask($user_id)
    {

        //calculate diff days with week end
        $intervalDateDays = $task->created_at->diffInDays($task->updated_at);

        //calculate diff days without week end
        $intervalDateDaysWithoutWeekEnd = $task->created_at->diffInDaysFiltered(function(Carbon $date) {
          return !$date->isWeekend();
        }, $task->updated_at);

        $totalDiffDays = $totalDiffDays + $intervalDateDaysWithoutWeekEnd;
    }

    public function taskCompletedPercentage()
    {
        // variables for presence task points
        $fromDate = new Carbon('first day of last month');
        $toDate   = new Carbon('last day of last month');

        $allTasks       = Task::all()->count();
        $taskCompleted  = Task::whereBetween('created_at', [ $fromDate, $toDate])->where('status', 'done')->count();

        if ($allTasks == 0) {
            $taskPercentage = 0;
        } else {
            $taskPercentage = (int)(($taskCompleted / $allTasks) * 100);
        }
        
        return $taskPercentage;
    }

    public function presenceName()
    {
        //initialize current date
        $date = \Carbon\Carbon::now();

        $previousMonth = $date->subMonth()->format('F');
        $year          = $date->subMonth()->format('Y');

        $presenceName  = $previousMonth . $year;
        return $presenceName;
    }

    public function getMonthList()
    {
        $date = \Carbon\Carbon::now(); //current time

        $months = array();

        array_push($months, $date->subMonth(6)->format('M-y'));
        $date = \Carbon\Carbon::now(); 
        array_push($months, $date->subMonth(5)->format('M-y'));
        $date = \Carbon\Carbon::now(); 
        array_push($months, $date->subMonth(4)->format('M-y'));
        $date = \Carbon\Carbon::now(); 
        array_push($months, $date->subMonth(3)->format('M-y'));
        $date = \Carbon\Carbon::now(); 
        array_push($months, $date->subMonth(2)->format('M-y'));
        $date = \Carbon\Carbon::now(); 
        array_push($months, $date->subMonth(1)->format('M-y'));

        return $months;
    }
}

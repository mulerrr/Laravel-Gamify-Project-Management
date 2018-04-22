<?php

namespace App\Http\Controllers;

use App\Survey;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SurveysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //initialize current date
        $date = \Carbon\Carbon::now();

        $month      = $date->format('F');
        $year       = $date->format('Y');

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

        return view('surveys.index')->with(['q1' => $q1])->with(['q2' => $q2])->with(['q3' => $q3])->with(['q4' => $q4])->with(['q5' => $q5])
        ->with(['q1p' => $q1p])->with(['q2p' => $q2p])->with(['q3p' => $q3p])->with(['q4p' => $q4p])->with(['q5p' => $q5p]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        //initialize current date
        $date = \Carbon\Carbon::now();

        $month      = $date->format('F');
        $year       = $date->format('Y');

        $user_id = Auth::user()->id;
        $surveyName = $month . $year . $user_id;

        $dataExist = Survey::where('name', $surveyName)->first();

        if($dataExist){
            $showSurvey = 'show';
        } else {
            $showSurvey = 'hide';
        }

        return view('surveys.create')->with(['showSurvey' => $showSurvey]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::check()){
            $user_id = Auth::user()->id;

            $date  = \Carbon\Carbon::now();
            $month = $date->format('F');
            $year  = $date->format('Y');

            $surveyName = $month . $year . $user_id;

            $survey = Survey::create([
                'name'       => $surveyName,
                'month'      => $month,
                'year'       => $year,
                'q1'         => $request->input('q1'),
                'q2'         => $request->input('q2'),
                'q3'         => $request->input('q3'),
                'q4'         => $request->input('q4'),
                'q5'         => $request->input('q5'),
                'suggestion' => $request->input('suggestion'),
                'user_id'    => Auth::user()->id,
            ]);

            if($survey){
                return back()->with('success', 'Survey has been posted');
            }
        }

        return back()->withInput()->with('errors', 'Error answering survey');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Presence  $Presence
     * @return \Illuminate\Http\Response
     */
}

<?php

namespace App\Http\Controllers;

use App\User;
use App\Project;
use App\Presence;
use App\PresenceUser;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PresencesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        //Data for the graphics
        $imam = User::where('username', 'imamprastio')->first();
        $imamID = $imam->id;
        $cumi = User::where('username', 'cumibakar')->first();
        $cumiID = $cumi->id;

        $mulers = Presence::where('user_id', $imamID)->limit(6)->orderBy('id', 'desc')->get();
        $cumis  = Presence::where('user_id', $cumiID)->limit(6)->orderBy('id', 'desc')->get();

        $months = $this->getMonthList();

        //Get all list of projects
        if(Auth::check()){

            $date = \Carbon\Carbon::now();
            $previousMonth = $date->subMonth()->format('F');
            $previousYear  = $date->subMonth()->format('Y');
            $getPresenceName = $previousMonth . $previousYear;
            $checkPresence = Presence::where('name', $getPresenceName)->first();

            //check if presence exist
            if($checkPresence) $addPresence = 'hide';
            else $addPresence = 'show';

            $presences = Presence::all()->where('month', $previousMonth);
            $users = User::where('role_id', 2)->get();

            return view('presences.index', ['presences' => $presences], ['users' => $users])
            ->with(['months' => $months])->with(['mulers' => $mulers])->with(['cumis' => $cumis])->with(['previousMonth' => $previousMonth])->with(['previousYear' => $previousYear])->with(['addPresence' => $addPresence]);
        }

        return view('auth.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::check()){
            $presences = Presence::all();
            $users = User::where('role_id', 2)->where('status', 'active')->get();

            //$projectTotal = Project::where('user_id', 1)->count();

            return view('presences.create', ['presences' => $presences], ['users' => $users]);
        }
        return view('presences.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        foreach ($request->entities as $entity) {
            $presenceName = $entity['month'] . $entity['year'];

            //Check if Exist
            $dataExist = Presence::where('name', $presenceName)->first();

            // if($dataExist){
            //     return back()->withInput()->with('errors', 'Data already exist!!');
            // } else {

                $presence = new Presence();

                $presenceName = $entity['month'] . $entity['year'];

                $presence->user_id  = (int)$entity['user_id'];
                $presence->days     = $entity['days'];
                $presence->max_days = $entity['max_days'];
                $presence->month    = $entity['month'];
                $presence->year     = $entity['year'];
                $presence->name     = $presenceName;

                $presence->save();
            //} 
        }
        
        return redirect()->route('presences.index')->with('success', 'Presence added successfully');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Presence  $Presence
     * @return \Illuminate\Http\Response
     */
    public function show(Presence $Presence)
    {
        //$Presence = Presence::where('id', $Presence->id)->first();
        $Presence = Presence::find($Presence->id);

        $comments = $Presence->comments;

        return view('presences.show', ['Presence'=>$Presence, 'comments'=>$comments]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Presence  $Presence
     * @return \Illuminate\Http\Response
     */
    public function edit(Presence $presence)
    {
        //passing parameter id ke halaman projects/edit
        $presence = Presence::find($presence->id);


        return view('presences.edit', ['presence'=>$presence]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Presence  $Presence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Presence $Presence)
    {
        //save data
        $PresenceUpdate = Presence::where('id', $Presence->id)
                                ->update([
                                    'days' => $request->input('days')
                                ]);

        if($PresenceUpdate){
            return redirect()->route('presences.index', ['Presence' => $Presence->id])->with('success', 'Presence updated successfully');
        }

        //redirect
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Presence  $Presence
     * @return \Illuminate\Http\Response
     */
    public function destroy(Presence $Presence)
    {
        $findPresence = Presence::find($Presence->id);
        if($findPresence->delete()){
            //redirect
            return redirect()->route('presences.index')->with('success', 'Presence deleted successfully');
        }

        return back()->withInput()->with('errors', 'Presence could not be deleted');
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
        //dd($months);
        return $months;
    }

    public function testArray()
    {
        //
    }
}
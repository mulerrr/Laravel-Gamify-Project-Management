<?php

namespace App\Http\Controllers;

use App\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ClientController extends Controller
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

    //$user_id = Auth::user()->id;

    public function index()
    {
    	$user_id = Auth::user()->id;
    	$review  = Review::where('user_id', $user_id)->first();
    	//dd($review);
    	$dataExist = '';

	    if($dataExist){
	        $showSurvey = 'show';
	    } else {
	        $showSurvey = 'hide';
	    }
	    
	    //return view
	    return view('homeClient', ['review' => $review]);
	}
}

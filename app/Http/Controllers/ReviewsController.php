<?php

namespace App\Http\Controllers;

use App\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $reviews  = Review::all();
        
        //return view
        return view('reviews.index', ['reviews' => $reviews]);
    }

    public function store(Request $request)
    {
        if(Auth::check()){
            $user_id = Auth::user()->id;

            $review = Review::create([
            	'review'   => $request->input('review'),
                'rating'  => $request->input('rating'),
                'user_id' => Auth::user()->id,
            ]);

            if($review){
                return back()->with('success', 'Your review has been posted');
            }
        }

        return back()->withInput()->with('errors', 'Error adding review');
    }

    public function update(Request $request, review $review)
    {
        //save data
        $reviewUpdate = Review::where('id', $review->id)
                                ->update([
                                    'review' => $request->input('review'),
                                    'rating' => $request->input('rating')
                                ]);

        if($reviewUpdate){
            return back()->with('success', 'Your review updated successfully!');
        }

        //redirect
        return back()->withInput();
    }

    public function destroy(Review $review)
    {
        $findReview = Review::find($review->id);
        if($findReview->delete()){
            //redirect
            return back()->with('success', 'Review deleted successfully');
        }

        return back()->with('errors', 'Review could not be deleted');
    }
}

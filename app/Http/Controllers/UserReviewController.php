<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Review;
use App\Models\Movie;
use App\Models\UserReview;

class UserReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function admin(){   
        
        $likes = UserReview::all();
        $reviewList = Review::all();
        $userList = User::all();

        return view('likes.admin')
            ->with('likes',$likes)
            ->with('reviewList',$reviewList)
            ->with('userList',$userList);
    }


    public function save(Request $request)
    {

        $this->validate($request,[
            'user' => 'required',
            'review' => 'required',
        ]);

        $user_id = $request->input('user');
        $review_id = $request->input('review');

        $like = new UserReview();
        $like->user_id = $user_id;
        $like->review_id = $review_id;
        $like->save();

        return redirect()->route('likes.admin')->with([
            'message' => "¡El nuevo like se ha subido correctamente!"
        ]);


    }
}
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
            'usuario' => 'required',
            'review' => 'required',
        ]);

        //todo que no meta duplicados

        $user_id = $request->input('usuario');
        $review_id = $request->input('review');

        $likes = UserReview::all();

        $yaRegistrado=false;

        foreach ($likes as $like) {
            if($like->user_id == $user_id && $like->review_id == $review_id){
                $yaRegistrado=true;
            }
        }

        if($yaRegistrado){
            return redirect()->route('likes.admin')->with([
                'errorMessage' => "¡A ese usuario ya le gusta esa reseña!"
            ]);    
        }else{
        

        $like = new UserReview();
        $like->user_id = $user_id;
        $like->review_id = $review_id;
        $like->save();

        return redirect()->route('likes.admin')->with([
            'message' => "¡El nuevo like se ha subido correctamente!"
        ]);
        }


    }
}
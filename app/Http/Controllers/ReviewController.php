<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Review;
use App\Models\User;


class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function admin()
    {
        $movieList = Movie::all();
        $reviewList = Review::all();
        $userList = User::all();

        return view('review.admin')
            ->with('movieList', $movieList)
            ->with('reviewList', $reviewList)
            ->with('userList', $userList);
    }

    public function save(Request $request)
    {

        $this->validate($request,[
            'movie' => 'required',
            'score' => 'required|integer|between:0,10',
            'opinion' => 'required',
            'user' => 'required'
        ]);

        $movie_id = $request->input('movie');
        $score = $request->input('score');
        $opinion = $request->input('opinion');
        $user_id = $request->input('user');

        $review = new Review();
        $review->user_id = $user_id;
        $review->movie_id = $movie_id;
        $review->score = $score;
        $review->opinion = $opinion;

        $review->save();

        return redirect()->route('review.admin')->with([
            'message' => "¡La reseña se ha subido correctamente!"
        ]);


    }
}

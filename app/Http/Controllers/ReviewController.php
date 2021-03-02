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

        $this->validate($request, [
            'movie' => 'required',
            'score' => 'required|integer|between:0,10',
            'opinion' => 'string|required',
            'usuario' => 'required'
        ]);

        $movie_id = $request->input('movie');
        $score = $request->input('score');
        $opinion = $request->input('opinion');
        $user_id = $request->input('usuario');

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

    public function delete($id)
    {

        if ($review = Review::find($id)) {

            $review->delete();
            return redirect()->route('review.admin')->with([
                'message' => "¡Reseña eliminada correctamente!"
            ]);
        } else {
            return redirect()->route('review.admin')->with([
                'errorMessage' => "Reseña no encontrada"
            ]);
        }
    }



    public function edit($id)
    {
        if ($review = Review::find($id)) {

            $movieList = Movie::all();
            $userList = User::all();

            return view('review.edit', ['review' => $review, 'movieList'=>$movieList, 'userList'=>$userList]);
        } else {
            return redirect()->route('review.admin')->with([
                'errorMessage' => "Reseña no encontrada"
            ]);
        }
    }

    public function update(Request $request, $id)
    {

        if ($review = Review::find($id)) {

            $id = $review->id;

            $this->validate($request, [
                'movie' => 'required',
                'score' => 'required|integer|between:0,10',
                'opinion' => 'string|required',
                'usuario' => 'required'
            ]);


            //TODO ver cuando se introduce pass y foto y cuando no
            $movie =  $request->input('movie');
            $score =  $request->input('score');
            $opinion = $request->input('opinion');
            $usuario = $request->input('usuario');

            $review->movie_id = $movie;
            $review->score = $score;
            $review->opinion = $opinion;
            $review->user_id = $usuario;

            $review->update();

            return redirect()->route('review.admin')
                ->with(['message' => '¡Reseña actualizada correctamente!']);
        } else {
            return redirect()->route('review.admin')
                ->with(['errorMessage' => 'No se encontró la reseña']);
        }
    }
}

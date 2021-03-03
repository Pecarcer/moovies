<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Review;
use App\Models\User;
use App\Models\UserReview;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Para llevar a la vista principal de reseñas
     */
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


    /**
     * Para guardar una reseña en la base de datos
     *
     * @param  \Illuminate\Http\Request  $request los datos de la reseña a guardar
     * 
     */
    public function save(Request $request)
    {

        $this->validate($request, [
            'movie' => 'required',
            'score' => 'required|integer|between:0,10',
            'opinion' => 'string|required',
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


        $reviewList = Review::all();
        $yaHecha = false;

        foreach ($reviewList as $reviewHecha) {
            if ($reviewHecha->user_id == $review->user_id && $reviewHecha->movie_id == $review->movie_id) {
                $yaHecha = true;
            }
        }

        if ($yaHecha) {

            return redirect()->route('review.admin')->with([
                'errorMessage' => "Ese usuario ya ha reseñado esa película"
            ]);
        } else {

            $review->save();

            return redirect()->route('review.admin')->with([
                'message' => "¡La reseña se ha subido correctamente!"
            ]);
        }
    }

    /**
     * Para eliminar una reseña
     *
     * @param  $id el id de la reseña a borrar
     */
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


   /**
     * Para llevar a la vista de editar una reseña
     *
     * @param  $id el id de la peli a editar
     */
    public function edit($id)
    {
        if ($review = Review::find($id)) {

            $movieList = Movie::all();
            $userList = User::all();

            return view('review.edit', ['review' => $review, 'movieList' => $movieList, 'userList' => $userList]);
        } else {
            return redirect()->route('review.admin')->with([
                'errorMessage' => "Reseña no encontrada"
            ]);
        }
    }

    
    /**
     * Para actualizar una reseña
     *
     * @param  $id el id de la reseña actualizar
     * @param $request los nuevos datos para actualizar
     */
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

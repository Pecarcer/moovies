<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Review;
use App\Models\UserReview;

class UserReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Para llevar a la vista principal de likes
     */
    public function admin(){   
        
        $likes = UserReview::all();
        $reviewList = Review::all();
        $userList = User::all();

        return view('likes.admin')
            ->with('likes',$likes)
            ->with('reviewList',$reviewList)
            ->with('userList',$userList);
    }

    /**
     * Para guardar un like en la base de datos
     *
     * @param  \Illuminate\Http\Request  $request los datos del like a guardar
     * 
     */
    public function save(Request $request)
    {

        $this->validate($request,[
            'usuario' => 'required',
            'review' => 'required',
        ]);

      
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

    /**
     * Para llevar a la vista de editar un like
     *
     * @param  $id el id del like a editar
     */    
    public function edit($id)
    {
        
        if ($like = UserReview::find($id)) {

            
            $reviewList = Review::all();
            $userList = User::all();            

            return view('likes.edit', ['like' => $like, 'reviewList'=>$reviewList, 'userList'=>$userList]);
        } else {
            return redirect()->route('likes.admin')->with([
                'errorMessage' => "Like no encontrado"
            ]);
        }
    }

        /**
     * Para actualizar un like
     *
     * @param  $id el id del like a actualizar
     * @param $request los nuevos datos para actualizar
     */
    public function update(Request $request, $id)
    {

        if ($like = UserReview::find($id)) {

            $id = $like->id;

            $this->validate($request, [
                'review' => 'required',
                'usuario' => 'required',
            ]);
            
            $review_id =  $request->input('review');
            $user_id =  $request->input('usuario');  

            $yaRegistrado=false;

            $likes = UserReview::All();

            foreach ($likes as $like) {
                if($like->user_id == $user_id && $like->review_id == $review_id){
                    $yaRegistrado=true;
                }
            }

            if($yaRegistrado){
                return redirect()->route('likes.admin')
                ->with(['errorMessage' => '¡A ese usuario ya le gusta esa reseña!']);
            }

            $like->review_id = $review_id;
            $like->user_id = $user_id;
            $like->update();

            return redirect()->route('likes.admin')
                ->with(['message' => '¡Like actualizado correctamente!']);
        } else {
            return redirect()->route('likes.admin')
                ->with(['errorMessage' => 'No se encontró el like']);
        }
    }

    /**
     * Para eliminar un like
     *
     * @param  $id el id del like a borrar
     */
    public function delete($id)
    {
        if ($like = UserReview::find($id)) {

            $like->delete();
            return redirect()->route('likes.admin')->with([
                'message' => "¡Like eliminado correctamente!"
            ]);
        } else {
            return redirect()->route('likes.admin')->with([
                'errorMessage' => "Like no encontrado"
            ]);
        }
    }
}
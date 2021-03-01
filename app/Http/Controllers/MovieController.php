<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Movie;

class MovieController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function admin(){        
        return view('movie.admin');
    }

    public function save(Request $request)
    {

        $this->validate($request,[
            'title' => 'required|string|max:255|unique:movies',
            'release' => 'required|date',
            'director' => 'required|string',
            'poster' => 'mimes:jpg,jpeg,png,gif'
        ]);


        $image_path =$request->file('poster');
        if($image_path){

            $image_path_name = time().$image_path->getClientOriginalName();

            Storage::disk('images')->put($image_path_name,File::get($image_path));
        }        
        

        Movie::create([
            'title' => $request->title,
            'release' => $request->release,
            'director' => $request->director,
            'poster'=> $image_path_name,
        ]);

        return redirect()->route('movie.admin')->with([
            'message' => "¡La película se ha añadido correctamente!"
        ]);
    }
}

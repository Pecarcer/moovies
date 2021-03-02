<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Movie;

class MovieController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function admin()
    {

        $movieList = Movie::all();
        return view('movie.admin')->with('movieList', $movieList);;
    }

    public function save(Request $request)
    {

        $this->validate($request, [
            'title' => 'required|string|max:255|unique:movies',
            'release' => 'required|date|date_format:Y-m-d',
            'director' => 'required|string',
            'poster' => 'mimes:jpg,jpeg,png,gif'
        ]);


        $image_path = $request->file('poster');
        if ($image_path) {

            $image_path_name = time() . $image_path->getClientOriginalName();

            Storage::disk('images')->put($image_path_name, File::get($image_path));
        }

        Movie::create([
            'title' => $request->title,
            'release' => $request->release,
            'director' => $request->director,
            'poster' => $image_path_name,
        ]);

        return redirect()->route('movie.admin')->with([
            'message' => "¡La película se ha añadido correctamente!"
        ]);
    }

    public function getImage($filename)
    {
        $file = Storage::disk('images')->get($filename);
        return new Response($file, 200);
    }

    public function delete($id)
    {
        if ($movie = Movie::find($id)) {

            $movie->delete();
            return redirect()->route('movie.admin')->with([
                'message' => "¡Pelicula eliminada correctamente!"
            ]);
        } else {
            return redirect()->route('movie.admin')->with([
                'errorMessage' => "Película no encontrada"
            ]);
        }
    }

    public function edit($id)
    {
        if ($movie = Movie::find($id)) {
            return view('movie.edit', ['movie' => $movie]);
        } else {
            return redirect()->route('movie.admin')->with([
                'errorMessage' => "Película no encontrada"
            ]);
        }
    }

    public function update(Request $request, $id)
    {

        if ($movie = Movie::find($id)) {

            $id = $movie->id;

            $this->validate($request, [
                'title' => 'required|string|max:255|unique:movies,title,' . $id,
                'release' => 'required|date|date_format:Y-m-d',
                'director' => 'required|string',
                'poster' => 'mimes:jpg,jpeg,png,gif'
            ]);


            //TODO ver cuando se introduce pass y foto y cuando no
            $title =  $request->input('title');
            $release =  $request->input('release');
            $director = $request->input('director');

            $movie->title = $title;
            $movie->release = $release;
            $movie->director = $director;


            if ($request->file('poster') != null) {

                $image_path = $request->file('poster');
                if ($image_path) {

                    $image_path_name = time() . $image_path->getClientOriginalName();

                    Storage::disk('images')->put($image_path_name, File::get($image_path));
                }

                $movie->poster = $image_path_name;
            }

            $movie->update();

            return redirect()->route('movie.admin')
                ->with(['message' => '¡Película actualizada correctamente!']);
        } else {
            return redirect()->route('movie.admin')
                ->with(['errorMessage' => 'No se encontró la película']);
        }
    }
}

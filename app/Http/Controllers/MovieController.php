<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Movie;
use Illuminate\Support\Facades\DB;

class MovieController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Para llevar a la vista principal de películas
     */
    public function admin()
    {

        $movieList = new Movie;

        if (request()->has('sort')) {
            $movieList = $movieList->orderBy(request('sort'));
        }

        $movieList = $movieList->paginate(4)->appends([
            'sort' => request('sort')
        ]);

        return view('movie.admin')->with('movieList', $movieList);
    }

    /**
     * Para guardar una película en la base de datos
     *
     * @param  \Illuminate\Http\Request  $request los datos de la película a guardar
     * 
     */
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


            Movie::create([
                'title' => $request->title,
                'release' => $request->release,
                'director' => $request->director,
                'poster' => $image_path_name,
            ]);

            return redirect()->route('movie.admin')->with([
                'message' => "¡La película se ha añadido correctamente!"
            ]);
        } else {
            return redirect()->route('movie.admin')->with([
                'errorMessage' => "No se puede añadir película sin un poster"
            ]);
        }
    }

    /**
     * Método para obtener la imagen relacionada a película
     *
     * @param  $filename el nombre del archivo poster de la pelicula
     */
    public function getImage($filename)
    {
        $file = Storage::disk('images')->get($filename);
        return new Response($file, 200);
    }

    /**
     * Para eliminar una película
     *
     * @param  $id el id de la peli a borrar
     */
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

    /**
     * Para llevar a la vista de editar una película
     *
     * @param  $id el id de la peli a editar
     */
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

    /**
     * Para actualizar una película
     *
     * @param  $id el id de la peli a actualizar
     * @param $request los nuevos datos para actualizar
     */
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

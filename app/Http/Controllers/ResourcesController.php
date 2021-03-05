<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResourcesController extends Controller
{
     /**
     * Método para obtener imagenes publicas para la web
     *
     * @param  $filename de la imagen a mostrar
     */
    public function getImage($filename)
    {
        $file = Storage::disk('public')->get($filename);
        return new Response($file, 200);
    }
}

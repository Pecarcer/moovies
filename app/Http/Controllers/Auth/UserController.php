<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    /**
    * Crea una nueva instancia del controlador
    */
    public function __construct()
    {
        $this->middleware('auth');   
    }


     /**
     * Manda a la vista todos los usuarios registrados.
     *
     * @return \Illuminate\Http\Response
     */

    /* public function listarUsers(Request $request)
    {
        
        if(!$request->get('pagination')){
            $page=10; //paginación por defecto
        }else{
            $page=$request->get('pagination');
            $arr['pagination']=$request->get('pagination');
        }
        
      
        if(Auth::user()->role == 'admin'){ //eres admin

            
            if(!$request|| isset($arr) && $request != $arr ){ //filtramos

                //Tipos de filtrado:
                $nombre= $request->get('buscaNombre');

                $email= $request->get('buscaEmail');

                $nick= $request->get('buscaNick');

                $fecha= $request->get('buscaFechaLogin');

                $tipo= $request->get('buscaTipo');

                //El usuario con los filtros:
                $users = User::nombre($nombre)->email($email)->nick($nick)->fecha($fecha)->tipo($tipo)->paginate($page);

                //Hacemos control
                if(count($users)==0){
                    $array=[
                        'success' => false,
                        'message' => 'No existe usuario con dichos datos en nuestra base de datos'
                    ];
                }else{
                    $array=[
                        'success' => true,
                        'users'=>$users
                    ];
                }

                //Y mandamos a la vista
                return view('/users/users',compact('users'),$array);

            }else{
            //Si no tiene request o la que tiene es solo de paginacion:

                //Listamos todos los users
                $users = User::paginate($page);

                //Hacemos control
                if(!$users){
                    $array=[
                        'success' => false,
                        'message' => 'No existe usuario con dichos datos en nuestra base de datos'
                    ];
                }else{
                    $array=[
                        'success' => true,
                        'users'=>$users
                    ];
                }

                //Devolvemos vista
                return view('/users/users',$array);
            }
        }else{ //no eres admin
            $array=[
                'window'=>'Home',
                'message' => 'Sólo disponible para administradores.'
            ];

            return view('/extras/error',$array);
        }
    }*/

    public function config(){
        return view('user.config');
    }
}

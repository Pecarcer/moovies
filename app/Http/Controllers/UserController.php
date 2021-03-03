<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Para llevar a la vista de nuestros datos
     */
    public function config()
    {
        return view('user.config');
    }

    /**
     * Para actualizar un usuario
     *
     * @param  $id el id del usuario a actualizar
     * @param $request los nuevos datos para actualizar
     */
    public function update(Request $request, $id)
    {

        if ($user = User::find($id)) {

            $id = $user->id;

            $this->validate($request, [
                'nick' => 'required|string|max:255|unique:users,nick,' . $id, //el punto $id es para que se haga una excepcion a la hora de validar el unique
                'email' => 'required|string|email|max:255|unique:users,email,' . $id,
                'password' => 'string|confirmed|min:4|nullable',
                'fullname' => 'required|string',
                'avatar' => 'mimes:jpg,jpeg,png,gif'
            ]);

            $nick =  $request->input('nick');
            $email =  $request->input('email');

            if ($request->input('password') != null) {
                $user->password = Hash::make($request->input('password'));
            }

            $fullname = $request->input('fullname');

            $user->nick = $nick;
            $user->email = $email;
            $user->fullname = $fullname;


            if ($request->file('avatar') != null) {

                $image_path = $request->file('avatar');
                if ($image_path) {

                    $image_path_name = time() . $image_path->getClientOriginalName();

                    Storage::disk('users')->put($image_path_name, File::get($image_path));
                }

                $user->avatar = $image_path_name;
            }

            $user->update();

            return redirect()->route('user.admin')
                ->with(['message' => '¡Usuario actualizado correctamente!']);
        } else {
            return redirect()->route('user.admin')
                ->with(['errorMessage' => 'No se encontró el usuario']);
        }
    }

    /**
     * Método para obtener la imagen relacionada al user
     *
     * @param  $filename el nombre del archivo avatar del user
     */
    public function getImage($filename)
    {
        $file = Storage::disk('users')->get($filename);
        return new Response($file, 200);
    }

    /**
     * Para llevar a la vista principal de usuarios
     */
    public function admin()
    {
        $userList = new User;


        if (request()->has('role')) {
            $userList = $userList->where('role', request('role'));
        }

        if (request()->has('sort')) {
            $userList = $userList->orderBy('id', request('sort'));
        }

        $userList = $userList->paginate(4)->appends([
            'role' => request('role'),
            'sort' => request('sort')
        ]);

        return view('user.admin')
            ->with('userList', $userList);
    }

        /**
     * Para guardar un usuario en la base de datos
     *
     * @param  \Illuminate\Http\Request  $request los datos del usuario a guardar
     * 
     */
    public function save(Request $request)
    {

        $this->validate($request, [
            'nick' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:4',
            'fullname' => 'required|string'
        ]);

        User::create([
            'nick' => $request->nick,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => "user",
            'fullname' => $request->fullname,
            'avatar' => "imagendefault.png",
            'remember_token' => Str::random(10),
        ]);

        return redirect()->route('user.admin')->with([
            'message' => "¡El usuario se ha añadido correctamente!"
        ]);
    }

        /**
     * Para eliminar un usuario
     *
     * @param  $id el id del usuario a borrar
     */
    public function delete($id)
    {

        if ($user = User::find($id)) {

            if ($user->id == \Auth::user()->id) {

                return redirect()->route('user.admin')->with([
                    'errorMessage' => "¡No puedes eliminarte a ti mismo!"
                ]);
            } else {
                $user->delete();
                return redirect()->route('user.admin')->with([
                    'message' => "¡Usuario eliminado correctamente!"
                ]);
            }
        } else {
            return redirect()->route('user.admin')->with([
                'errorMessage' => "Usuario no encontrado"
            ]);
        }
    }

    /**
     * Para llevar a la vista de editar un usuario
     *
     * @param  $id el id del ussuario a editar
     */
    public function edit($id)
    {
        if ($user = User::find($id)) {
            return view('user.edit', ['user' => $user]);
        } else {
            return redirect()->route('user.admin')->with([
                'errorMessage' => "Usuario no encontrado"
            ]);
        }
    }
}

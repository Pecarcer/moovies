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

    public function config()
    {
        return view('user.config');
    }

    public function update(Request $request)
    {
        
        $user =\Auth::user();
        $id = $user->id;

        $this->validate($request, [
            'nick' => 'required|string|max:255|unique:users,nick,' . $id,
            'email' => 'required|string|email|max:255|unique:users,email,'. $id,
            //'password' => 'string|confirmed|min:8',
            'fullname' => 'required|string',
            //'avatar' => 'mimes:jpg,jpeg,png,gif'
        ]);        
        

        //TODO ver cuando se introduce pass y foto y cuando no
        $nick =  $request->input('nick');
        $email =  $request->input('email');
        //$password = Hash::make($request->input('password'),   
        $fullname = $request->input('fullname');

        $user->nick = $nick;
        $user->email = $email;
        //$user->password = $password;
        $user->fullname = $fullname;


        $image_path =$request->file('avatar');
        if($image_path){

            $image_path_name = time().$image_path->getClientOriginalName();

            Storage::disk('users')->put($image_path_name,File::get($image_path));
        }
        
        $user->avatar = $image_path_name;       

        $user->update();

        return redirect()->route('config')
            ->with(['message'=>'Usuario actualizado correctamente']);  
    }

    public function getImage($filename)
    {
        $file = Storage::disk('users')->get($filename);
        return new Response($file,200);
    }

    public function profile()
    {        
        return view('user.profile');
    }

    public function admin()
    {
        
        $userList = User::all();

        return view('user.admin')
        ->with('userList', $userList);;
    }

    public function save(Request $request)
    {

        $this->validate($request,[
            'nick' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'fullname' => 'required|string'
        ]);

        User::create([
            'nick' => $request->nick,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role'=>"user",
            'fullname'=>$request->fullname,
            'avatar'=>"imagendefault.png",
            'remember_token' => Str::random(10),
        ]);

        return redirect()->route('user.admin')->with([
            'message' => "¡El usuario se ha añadido correctamente!"
        ]);
    }

}

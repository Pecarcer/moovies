<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class UserController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }
    public function config(){
        return view('user.config');
    }

    public function update(Request $request){
        
        $user =\Auth::user();
        $id = $user->id;

        $validate = $this->validate($request, [
            'nick' => 'required|string|max:255|unique:users,nick,' . $id,
            'email' => 'required|string|email|max:255|unique:users,email,'. $id,
            //'password' => 'string|confirmed|min:8',
            'fullname' => 'required|string'
        ]);        
        

        //TODO ver cuando se introduce pass y cuando no
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

    public function getImage($filename){
        $file = Storage::disk('users')->get($filename);
        return new Response($file,200);
    }
}

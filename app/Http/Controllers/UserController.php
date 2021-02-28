<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function config(){
        return view('user.config');
    }

    public function update(Request $request){

        $user =\Auth::user();
        $id = $user->id;

        $validate = $this->validate($request, [
            'nick' => 'required|string|max:255|unique:users,nick,' . $id,
            'email' => 'required|string|email|max:255|unique:users,email,'. $id,
            'password' => 'string|confirmed|min:8',
            'fullname' => 'required|string'
        ]);        
        
        $nick =  $request->input('nick');
        $email =  $request->input('email');
        $password = $request->input('password');    
        $fullname = $request->input('fullname');

        $user->nick = $nick;
        $user->email = $email;
        $user->password = $password;
        $user->fullname = $fullname;

        $user->update();

        return redirect()->route('config')
            ->with(['message'=>'Usuario actualizado correctamente']);



      
        

    }
}

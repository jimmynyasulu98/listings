<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //
    public function create(){
        return view('users.register');
        } 
    public function store(Request $request){ 
        $form_fileds = $request->validate([
            'name'=> ['required','min:2'],
            'email'=> ['required','email', Rule::unique('users', 'email')],
            'password'=> 'required|confirmed|min:3'
        ]);
        $form_fileds['password'] = bcrypt($form_fileds['password']);    
        $user = User::create($form_fileds);
        auth()->login($user);

        return redirect('/')->with('message','User created and logged in');
    }
    public function logout(Request $request){ 
       auth()->logout();
       $request->session()->invalidate();
       $request->session()->regenerateToken();
       return redirect('/')->with('message','Logged out successifully');
    }

    public function login(){    
        return view('users.login');
    }

    public function authenticate(Request $request){
        $form_fileds = $request->validate([
            'email'=> ['required'],
            'password'=> 'required'
        ]);

       if(auth()->attempt($form_fileds)){
            $request->session()->regenerate();
            return redirect('/')->with('message','You are successifully logged in');
       }

       return back()->withErrors(['email'=>'Invalid login details'])->onlyInput('email');
    }
}

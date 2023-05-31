<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function logout(){
        auth()->logout();
        return redirect('/')->with('success', 'You are now logged out.');
    }
    public function showCorrectHomepage(){
        if(auth()->check()){
            return view('homepage-feed');
        }else{
            return view('homepage');
        }
    }
    public function login(Request $request){
        $incomingFields = $request->validate([
            'loginusername' => 'required',
            'loginpassword' => 'required'
        ]);

        if(auth()->attempt(['username' => $incomingFields['loginusername'], 'password' => $incomingFields['loginpassword']])){
            //creates session value through cookie
            $request->session()->regenerate();
            return redirect('/')->with('success','You have successfully logged in.');
        }else {
            return redirect('/')->with('failure','Invalid login.');
        }
    }
    public function register(Request $request) {
        $incomingFields = $request->validate([
            'username' => ['required','min:3','max:30', Rule::unique('users','username')],
            'email' => ['required','email',Rule::unique('users','email')],
            'password' => ['required','min:8','confirmed']
        ]);
        //hashing the password
        $incomingFields['password'] = bcrypt($incomingFields['password']);
        //creates a new record in the database
        $user = User::create($incomingFields);
        //logins a new user
        auth()->login($user);
        return redirect('/')->with('success','Thank you for creating an account');
    }
}

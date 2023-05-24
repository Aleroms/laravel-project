<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
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
            return "Congrats!";
        }else {
            return 'sorry!';
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
        User::create($incomingFields);
        return 'hello from register func';
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Follow;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function storeAvatar(Request $request){
        $request->validate([
            'avatar' => 'required|image|max:3000'
        ]);
        
        $user = auth()->user();
        $filename = $user->id . '-' . uniqid() . '.jpg';
        //converts user's image into a reshaped 120x120px jpg
        $imgData = Image::make($request->file('avatar'))->fit(120)->encode('jpg');
        Storage::put('public/avatars/' . $filename, $imgData);

        $oldAvatar = $user->avatar;

        //updates database
        $user->avatar = $filename;
        $user->save();

        if($oldAvatar != "/fallback-avatar.jpg"){
            Storage::delete(str_replace('/storage/','public/',$oldAvatar));
        }
        return back()->with('success', 'successfully uploaded');
    }
    public function showAvatarForm(){
        return view('avatar-form');
    }
    //cannot be called from routes file
    private function getSharedData(User $user){
        $currentlyFollowing = 0;

        if(auth()->check()){
            $currentlyFollowing = Follow::where([['user_id','=',auth()->user()->id],['followeduser','=',$user->id]])->count();
        }

        View::share('sharedData',[
            'username' => $user->username,
            'postCount' => $user->posts()->count(),
            'avatar' => $user->avatar,
            'currentlyFollowing' => $currentlyFollowing
        ]);
    }

    public function profile(User $user){
        $this->getSharedData($user);
        //arrow looks for username property
        return view('profile-posts', [
            'posts' => $user->posts()->latest()->get()
        ]);
    }
    public function profileFollowers(User $user){
        $this->getSharedData($user);
        //arrow looks for username property
        return view('profile-followers', [
            'posts' => $user->posts()->latest()->get()
        ]);
    }
    public function profileFollowing(User $user){
        $this->getSharedData($user);
        //arrow looks for username property
        return view('profile-following', [
            'posts' => $user->posts()->latest()->get()
        ]);
    }
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

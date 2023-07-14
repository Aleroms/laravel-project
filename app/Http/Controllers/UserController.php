<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Follow;
use Illuminate\Http\Request;
use App\Events\OurExampleEvent;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
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
            'currentlyFollowing' => $currentlyFollowing,
            'followersCount' => $user->followers()->count(),
            'followingCount' => $user->followingTheseUsers()->count()
        ]);
    }

    public function profile(User $user){
        $this->getSharedData($user);
        //arrow looks for username property
        return view('profile-posts', [
            'posts' => $user->posts()->latest()->get()
        ]);
    }
    public function profileRaw(User $user){
        return response()->json([
            'theHTML' => view('profile-posts-only',[
                'posts' => $user->posts()->latest()->get()
            ])->render(),
            'docTitle' => $user->username . "'s Profile"
        ]);
    }
    public function profileFollowers(User $user){
        $this->getSharedData($user);
        return view('profile-followers', [
            'followers' => $user->followers()->latest()->get()
        ]);
    }
    public function profileFollowersRaw(User $user){
        
        return response()->json([
            'theHTML' => view('profile-followers-only',[
                'followers' => $user->followers()->latest()->get()
            ])->render(),
            'docTitle' => $user->username. "'s Followers"
        ]);
    }
    public function profileFollowing(User $user){
        $this->getSharedData($user);
        return view('profile-following', [
            'following' => $user->followingTheseUsers()->latest()->get()
        ]);
    }
    public function profileFollowingRaw(User $user){

        return response()->json([
            'theHTML' => view('profile-following-only',[
                'following' => $user->followingTheseUsers()->latest()->get()
            ])->render(),
            'docTitle' => 'Who ' . $user->username . " Follows"
        ]);
    }
    
    public function logout(){
        event(new OurExampleEvent([
            'username' => auth()->user()->username,
            'action' => 'logout'
        ]));
        auth()->logout();
        return redirect('/')->with('success', 'You are now logged out.');
    }
    public function showCorrectHomepage(){
        if(auth()->check()){
            return view('homepage-feed',[
                'posts' => auth()->user()->feedPosts()->latest()->paginate(8)
            ]);
        }else{
            $postCount = Cache::remember('postCount',20,function(){
                return Post::count();
            });
            return view('homepage',[
                'postCount' => 39
            ]);
        }
    }
    public function loginAPI(Request $request){
        $incomingFields = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        //only returns true if it is a valid username/pw
        if(auth()->attempt($incomingFields)){
            $user = User::where('username',$incomingFields['username'])->first();
            $token = $user->createToken('apptocken')->plainTextToken;
            return $token;
        }
        return 'srry';
    }
    public function login(Request $request){
        $incomingFields = $request->validate([
            'loginusername' => 'required',
            'loginpassword' => 'required'
        ]);

        if(auth()->attempt(['username' => $incomingFields['loginusername'], 'password' => $incomingFields['loginpassword']])){
            //creates session value through cookie
            $request->session()->regenerate();
            //fires event
            event(new OurExampleEvent([
                'username' => auth()->user()->username,
                'action' => 'login'
            ]));
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

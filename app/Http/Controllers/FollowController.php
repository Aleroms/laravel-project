<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function createFollow(User $user){
        //you cannot follow yourself
        if($user->id == auth()->user()->id){
            return back()->with('failure', 'you cannot follow yourself');
        }
        //cannot follow someone you are already following
        $existCheck = Follow::where([['user_id', '=', auth()->user()->id],['followeduser','=',$user->id]])->count();

        if($existCheck){
            return back()->with('failure','you are already following that user');
        }


        $newFollow = new Follow;
        $newFollow->user_id = auth()->user()->id;
        $newFollow->followeduser = $user->id;
        $newFollow->save();

        return back()->with('success', 'User sucessfully followed.');
    }
    public function removeFollow(User $user){
        Follow::where([['user_id','=',auth()->user()->id],['followeduser','=',$user->id]])->delete();
        return back()->with('success','user successfully unfollowed');
    }
}

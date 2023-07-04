<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;
    //relationship functions
    public function userDoingTheFollowing(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function userBeingFollowed(){
        //be careful; case sensitive!
        return $this->belongsTo(User::class,'followedUser');
    }
}

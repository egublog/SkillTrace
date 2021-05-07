<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Follow;

class FollowingController extends Controller
{
    public function index(int $userId)
    {
        $myId = Auth::id();
        $followings = Follow::following($userId)->get();

        return view('MyService.friends-list', compact('myId', 'followings', 'userId'));
    }

    public function follow(int $userId)
    {
        $myId = Auth::id();
        $myAccount = User::find($myId);

        $myAccount->follow()->attach($userId);
    }

    public function unfollow(int $userId)
    {
        $myId = Auth::id();
        $myAccount = User::find($myId);

        $myAccount->follow()->detach($userId);
    }
}

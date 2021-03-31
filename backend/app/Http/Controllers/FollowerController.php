<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Follow;

class FollowerController extends Controller
{
     public function index($userId)
    {
        $myId = Auth::id();
        $followers = Follow::where('user_to_id', $userId)->get();

        return view('MyService.friends-list', compact('myId', 'followers', 'userId'));
    }
}

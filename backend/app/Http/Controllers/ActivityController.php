<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Follow;

class ActivityController extends Controller
{
    //シングルコントローラー
    public function __invoke()
    {
        $myId = Auth::id();
        $followerAccounts = Follow::follower($myId)->get();

        return view('MyService.activity', compact('myId', 'followerAccounts'));
    }
}

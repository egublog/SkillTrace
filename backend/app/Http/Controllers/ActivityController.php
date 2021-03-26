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
        $follower_accounts = Follow::where('user_to_id', $myId)->get();
    
        return view('MyService.activity', compact('myId', 'follower_accounts'));
    }
}

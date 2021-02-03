<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Area;
use App\History;
use App\Language;
use App\User_language;
use App\Follow;

class ActivityController extends Controller
{
    //
    public function activity()
    {
        $myId = Auth::id();
        $myAccount = User::find($myId);
        $friendsId = Follow::where('user_to_id', $myId)->get(['user_id']);

        $follower_accounts = Follow::where('user_to_id', $myId)->get();

        return view('MyService.activity')->with([
            'follower_accounts' => $follower_accounts
        ]);
    }

}

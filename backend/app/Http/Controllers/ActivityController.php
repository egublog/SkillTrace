<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Area;
use App\Models\History;
use App\Models\Language;
use App\Models\User_language;
use App\Models\Follow;

class ActivityController extends Controller
{
    //
    public function __invoke()
    {
        $myId = Auth::id();
        // $myAccount = User::find($myId);
        // $friendsId = Follow::where('user_to_id', $myId)->get(['user_id']);
    
        $follower_accounts = Follow::where('user_to_id', $myId)->get();
    
        return view('MyService.activity', compact('myId', 'follower_accounts'));
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\User_language;
use App\Models\Follow;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $myId = Auth::id();
        $account = User::find($myId);

        return view('home', compact('myId', 'account'));
    }


    public function home($userId)
    {
        $myId = Auth::id();
        $myAccount = User::find($myId);

        $languages = User_language::where('user_id', $userId)->get();
        $account = User::findOrFail($userId);

        $follow_check = Follow::where('user_id', $myId)->where('user_to_id', $userId)->first();

        if($follow_check == null) {
            $follow_check = false;
        }else {
            $follow_check = true;
        }

        return view('MyService.home', compact('myId', 'myAccount', 'userId', 'account', 'languages', 'follow_check'));
    }
}

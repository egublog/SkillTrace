<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserLanguage;
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

        $languages = UserLanguage::where('user_id', $userId)->get();
        $account = User::findOrFail($userId);

        $follow_check = Follow::mutualFollow($myId, $userId)->first();

        //すでにフォローしているかどうかの判定
        Follow::followCheck($follow_check);

        return view('MyService.home', compact('myId', 'myAccount', 'userId', 'account', 'languages', 'follow_check'));
    }
}

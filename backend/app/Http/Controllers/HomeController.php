<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\User;
use App\Models\Area;
use App\Models\History;
use App\Models\Language;
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

    // public function home($userId) {
    //     $myId = Auth::id();

    //     $userAccount = User::findOrFail($userId);

    //     $languages = User_language::where('user_id', $userId)->get();

    //     $followCheck = Follow::where('user_id', $myId)->where('user_to_id', $friendId)->first();

    //     return view('MyService.home')->with([
    //         'myId' => $myId,
    //         'userAccount' => $userAccount,
    //         'userId' => $userId,
    //         'languages' => $languages
    //     ]);
    // }

    public function my_home($userId)
    {
        $myId = Auth::id();
        $myAccount = User::find($myId);
        $account = User::findOrFail($userId);
        $languages = User_language::where('user_id', $myId)->get();

        

        return view('MyService.home', compact('myId', 'myAccount', 'account', 'languages', 'userId'));
    }

    public function friend_home($friendId)
    {
        $myId = Auth::id();
        $myAccount = User::find($myId);
        $friend_account = User::find($friendId);
        $languages = User_language::where('user_id', $friendId)->get();

        $follow_check = Follow::where('user_id', $myId)->where('user_to_id', $friendId)->first();

        // return redirect()->route('home.my_home', ['userId' => $friendId])->with([
        //     'myId' => $myId,
        //     'account' => $friend_account,
        //     'languages' => $languages,
        //     'follow_check' => $follow_check,
        //     'userId' => $friendId
        // ]);

        return view('MyService.home')->with([
            'myId' => $myId,
            'myAccount' => $myAccount,
            'account' => $friend_account,
            'languages' => $languages,
            'follow_check' => $follow_check,
            'userId' => $friendId
        ]);
    }
}

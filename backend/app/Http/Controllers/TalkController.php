<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Follow;
use App\Models\Talk;
use App\Queries\SearchFollowing;
use App\Http\Requests\TalkRequest;
use App\Http\Requests\SearchTalkUserRequest;

class TalkController extends Controller
{
    //
    public function index()
    {
        $myId = Auth::id();

        $followingAccounts = Follow::following($myId)->get();

        return view('MyService.talk', compact('myId', 'followingAccounts'));
    }

    public function search(SearchTalkUserRequest $request)
    {

        $myId = Auth::id();
        $searchResultName = $request->input('name');

        $followingAccounts = SearchFollowing::search($myId, $searchResultName)->get();

        return view('MyService.talk', compact('myId', 'followingAccounts'));
    }

    public function show($theFriendId)
    {
        $theFriendAccount = User::find($theFriendId);

        $myId = Auth::id();

        $followingAccounts = Follow::following($myId)->get();

        $yetColumns = Talk::talking($theFriendId)->talked($myId)->get();

        Talk::readCheck($yetColumns);

        $talks = Talk::talk($myId, $theFriendId)->get();

        return view('MyService.talk-show', compact('myId', 'theFriendId', 'followingAccounts', 'theFriendAccount', 'talks'));
    }

    public function store($theFriendId, TalkRequest $request)
    {
        $myId = Auth::id();
        $message = $request->input('message');

        $talks = new Talk;
        $talks->user_id = $myId;
        $talks->user_to_id = $theFriendId;
        $talks->talk_body = $message;
        $talks->yet = false;
        $talks->save();

        return redirect()->route('talks.show', ['theFriendId' => $theFriendId]);
    }
}

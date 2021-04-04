<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Follow;
use App\Models\Talk;
use App\Queries\SearchFollowing;

class TalkController extends Controller
{
    //
    public function index()
    {
        $myId = Auth::id();

        $followingAccounts = Follow::following($myId)->get();

        return view('MyService.talk', compact('myId', 'followingAccounts'));
    }

    public function search(Request $request)
    {

        $myId = Auth::id();
        $search_result_name = $request->input('name');

        // $followingAccounts = Follow::following($myId)->searchName($search_result_name)->get();

        $followingAccounts = SearchFollowing::get($myId, $search_result_name);

        return view('MyService.talk', compact('myId', 'followingAccounts'));
    }

    public function show($theFriendId)
    {
        $theFriendAccount = User::find($theFriendId);

        $myId = Auth::id();

        $followingAccounts = Follow::following($myId)->get();

        $yetColumns = Talk::where('user_id', $theFriendId)
            ->where('user_to_id', $myId)
            ->get();

        if (isset($yetColumns->first()->user_id))
            foreach ($yetColumns as $yetColumn) {
                $yetColumn->yet = true;
                $yetColumn->save();
            }

        $talks = Talk::where('user_id', $myId)
            ->where('user_to_id', $theFriendId)
            ->orWhere('user_id', $theFriendId)
            ->where('user_to_id', $myId)
            ->get();

        return view('MyService.talk-show', compact('myId', 'theFriendId', 'followingAccounts', 'theFriendAccount', 'talks'));
    }

    public function store($theFriendId, Request $request)
    {
        $myId = Auth::id();
        $my_msg = $request->input('message');

        $talks = new Talk;
        $talks->user_id = $myId;
        $talks->user_to_id = $theFriendId;
        $talks->talk_body = $my_msg;
        $talks->yet = false;
        $talks->save();

        $talks = Talk::where('user_id', $myId)->where('user_to_id', $theFriendId)->orWhere('user_id', $theFriendId)->where('user_to_id', $myId)->get();

        $theFriendAccount = User::find($theFriendId);

        $myAccount = User::find($myId);

        $followingAccounts = Follow::following($myId)->get();

        return view('MyService.talk-show', compact('myId', 'theFriendId', 'followingAccounts', 'theFriendAccount', 'talks'));
    }
}

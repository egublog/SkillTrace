<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Follow;
use App\Models\Talk;

class TalkController extends Controller
{
    //
    public function index()
    {
        $myId = Auth::id();

        $following_accounts = Follow::where('user_id', $myId)->get();

        return view('MyService.talk', compact('myId', 'following_accounts'));
    }

    public function search(Request $request)
    {

        $myId = Auth::id();
        $search_result_name = $request->input('name');

        $following_accounts = Follow::where('user_id', $myId)->whereHas('user_following', function ($query) use ($search_result_name) {
            $query->where('name', 'like', "%$search_result_name%");
        })->get();

        return view('MyService.talk', compact('myId', 'following_accounts'));
    }

    public function show($theFriendId)
    {
        $theFriendAccount = User::find($theFriendId);

        $myId = Auth::id();
        $myAccount = User::find($myId);
        $friendsId = Follow::where('user_to_id', $myId)->get(['user_id']);

        $following_accounts = Follow::where('user_id', $myId)->get();

        $yetColumns = Talk::where('user_id', $theFriendId)->where('user_to_id', $myId)->get();

        if (isset($yetColumns->first()->user_id))
            foreach ($yetColumns as $yetColumn) {
                $yetColumn->yet = true;
                $yetColumn->save();
            }

        $talkDates = Talk::where('user_id', $myId)->where('user_to_id', $theFriendId)->orWhere('user_id', $theFriendId)->where('user_to_id', $myId)->get();

        return view('MyService.talk_show', compact('myId', 'theFriendId', 'following_accounts', 'theFriendAccount', 'talkDates'));
    }

    public function store($theFriendId, Request $request)
    {
        $myId = Auth::id();
        $theFriendId = $request->input('id');
        $my_msg = $request->input('message');

        $talks = new Talk;
        $talks->user_id = $myId;
        $talks->user_to_id = $theFriendId;
        $talks->talk_body = $my_msg;
        $talks->yet = false;
        $talks->save();

        $talkDates = Talk::where('user_id', $myId)->where('user_to_id', $theFriendId)->orWhere('user_id', $theFriendId)->where('user_to_id', $myId)->get();

        $theFriendAccount = User::find($theFriendId);

        $myAccount = User::find($myId);

        $following_accounts = Follow::where('user_id', $myId)->get();

        return view('MyService.talk_show', compact('myId', 'theFriendId', 'following_accounts', 'theFriendAccount', 'talkDates'));
    }
}

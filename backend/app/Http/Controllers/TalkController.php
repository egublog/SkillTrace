<?php

namespace App\Http\Controllers;

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

        $talkLists = Talk::talkingListLatest($myId)->get();

        $talkingUsers = Talk::getTalkingList($myId, $talkLists);

        return view('MyService.talk', compact('myId', 'talkingUsers'));
    }

    public function search(SearchTalkUserRequest $request)
    {
        $myId = Auth::id();
        $searchResultName = $request->input('talk_search_name');

        $talkLists = Talk::talkingListLatest($myId)->get();

        $talkingUsersBeforeSearch = Talk::getTalkingList($myId, $talkLists);

        $talkingUsers = Talk::search($talkingUsersBeforeSearch, $searchResultName);

        $request->flash();

        return view('MyService.talk', compact('myId', 'talkingUsers'));
    }

    public function show(int $theFriendId)
    {
        $theFriendAccount = User::find($theFriendId);

        $myId = Auth::id();

        $talkLists = Talk::talkingListLatest($myId)->get();

        $talkingUsers = Talk::getTalkingList($myId, $talkLists);

        $yetColumns = Talk::talking($theFriendId)->talked($myId)->get();
        Talk::readCheck($yetColumns);

        $talks = Talk::talk($myId, $theFriendId)->get();

        return view('MyService.talk-show', compact('myId', 'theFriendId', 'talkingUsers', 'theFriendAccount', 'talks'));
    }

    public function store(int $theFriendId, TalkRequest $request)
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

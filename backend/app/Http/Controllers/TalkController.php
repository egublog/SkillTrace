<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Follow;
use App\Models\Talk;
use App\Queries\SearchFollowing;
use App\Http\Requests\TalkRequest;
use App\Http\Requests\SearchTalkUserRequest;
use App\Repositories\UserRepositoryInterface;
use App\Services\UserAuthServiceInterface;

class TalkController extends Controller
{
    protected $userAuthService;
    protected $userRepository;

    public function __construct(
        UserAuthServiceInterface $userAuthService,
        UserRepositoryInterface $userRepository
    )
    {
        $this->userAuthService = $userAuthService;
        $this->userRepository  = $userRepository;
    }

    public function index()
    {
        $myId      = $this->userAuthService->getLoginUserId();

        $talkLists = Talk::talkingListLatest($myId)->get();

        $talkingUsers = Talk::getTalkingList($myId, $talkLists);

        return view('MyService.talk', compact('myId', 'talkingUsers'));
    }

    public function search(SearchTalkUserRequest $request)
    {
        $myId             = $this->userAuthService->getLoginUserId();
        $searchResultName = $request->input('talk_search_name');

        $talkLists = Talk::talkingListLatest($myId)->get();

        $talkingUsersBeforeSearch = Talk::getTalkingList($myId, $talkLists);

        $talkingUsers = Talk::search($talkingUsersBeforeSearch, $searchResultName);

        $request->flash();

        return view('MyService.talk', compact('myId', 'talkingUsers'));
    }

    public function show(int $theFriendId)
    {
        $theFriendAccount = $this->userRepository->findById($theFriendId);

        $myId      = $this->userAuthService->getLoginUserId();

        $talkLists = Talk::talkingListLatest($myId)->get();

        $talkingUsers = Talk::getTalkingList($myId, $talkLists);

        $yetColumns = Talk::talking($theFriendId)->talked($myId)->get();
        Talk::readCheck($yetColumns);

        $talks = Talk::talk($myId, $theFriendId)->get();

        return view('MyService.talk-show', compact('myId', 'theFriendId', 'talkingUsers', 'theFriendAccount', 'talks'));
    }

    public function store(int $theFriendId, TalkRequest $request)
    {
        $myId    = $this->userAuthService->getLoginUserId();
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

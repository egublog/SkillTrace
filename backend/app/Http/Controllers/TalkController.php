<?php

namespace App\Http\Controllers;

use App\Models\Talk;
use App\Http\Requests\TalkRequest;
use App\Http\Requests\SearchTalkUserRequest;
use App\Repositories\UserRepositoryInterface;
use App\Services\UserAuthServiceInterface;

class TalkController extends Controller
{
    protected $userAuthService;
    protected $userRepository;
    protected $talkRepository;

    public function __construct(
        UserAuthServiceInterface $userAuthService,
        UserRepositoryInterface $userRepository,
        TalkRepositoryInterface $talkRepository
    )
    {
        $this->userAuthService = $userAuthService;
        $this->userRepository  = $userRepository;
        $this->talkRepository  = $talkRepository;
    }

    public function index()
    {
        $myId      = $this->userAuthService->getLoginUserId();

        $talkLists = $this->talkRepository->getLatestByUserIdOrUserToId($myId);

        $talkingUsers = Talk::getTalkingList($myId, $talkLists);

        return view('MyService.talk', compact('myId', 'talkingUsers'));
    }

    public function search(SearchTalkUserRequest $request)
    {
        $myId             = $this->userAuthService->getLoginUserId();
        $searchResultName = $request->input('talk_search_name');

        $talkLists = $this->talkRepository->getLatestByUserIdOrUserToId($myId);

        $talkingUsersBeforeSearch = Talk::getTalkingList($myId, $talkLists);

        $talkingUsers = Talk::search($talkingUsersBeforeSearch, $searchResultName);

        $request->flash();

        return view('MyService.talk', compact('myId', 'talkingUsers'));
    }

    public function show(int $theFriendId)
    {
        $theFriendAccount = $this->userRepository->findById($theFriendId);

        $myId      = $this->userAuthService->getLoginUserId();

        $talkLists = $this->talkRepository->getLatestByUserIdOrUserToId($myId);

        $talkingUsers = Talk::getTalkingList($myId, $talkLists);

        $yetColumns = $this->talkRepository->getByUserIdOrUserToId($theFriendId, $myId);
        Talk::readCheck($yetColumns);

        $talks = $this->talkRepository->getTalkByTheFriendId($myId, $theFriendId);

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

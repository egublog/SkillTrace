<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Follow;
use App\Services\UserAuthServiceInterface;

class FollowingController extends Controller
{
    protected $userAuthService;

    public function __construct(
        UserAuthServiceInterface $userAuthService
    )
    {
        $this->userAuthService = $userAuthService;
    }

    public function index(int $userId)
    {
        $myId       = $this->userAuthService->getLoginUserId();
        $followings = Follow::following($userId)->get();

        return view('MyService.friends-list', compact('myId', 'followings', 'userId'));
    }

    public function follow(int $userId)
    {
        $myId      = $this->userAuthService->getLoginUserId();
        $myAccount = User::find($myId);

        $myAccount->follow()->attach($userId);
    }

    public function unfollow(int $userId)
    {
        $myId      = $this->userAuthService->getLoginUserId();
        $myAccount = User::find($myId);

        $myAccount->follow()->detach($userId);
    }
}

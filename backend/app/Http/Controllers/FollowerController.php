<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Services\UserAuthServiceInterface;

class FollowerController extends Controller
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
        $myId      = $this->userAuthService->getLoginUserId();
        $followers = Follow::follower($userId)->get();

        return view('MyService.friends-list', compact('myId', 'followers', 'userId'));
    }
}

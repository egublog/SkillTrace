<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Services\UserAuthServiceInterface;

class ActivityController extends Controller
{
    protected $userAuthService;

    public function __construct(
        UserAuthServiceInterface $userAuthService
    )
    {
        $this->userAuthService = $userAuthService;
    }

    public function __invoke()
    {
        $myId             = $this->userAuthService->getLoginUserId();
        $followerAccounts = Follow::follower($myId)->get();

        return view('MyService.activity', compact('myId', 'followerAccounts'));
    }
}

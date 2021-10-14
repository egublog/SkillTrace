<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Repositories\FollowRepositoryInterface;
use App\Services\UserAuthServiceInterface;

class ActivityController extends Controller
{
    protected $userAuthService;
    protected $followRepository;

    public function __construct(
        UserAuthServiceInterface $userAuthService,
        FollowRepositoryInterface $followRepository
    )
    {
        $this->userAuthService  = $userAuthService;
        $this->followRepository = $followRepository;
    }

    public function __invoke()
    {
        $myId             = $this->userAuthService->getLoginUserId();

        // NOTE: 自分をfollowしている人を取得
        $followerAccounts = $this->followRepository->getByUserToId($myId);
        $followerAccounts->load('user_follower');

        return view('MyService.activity', compact('myId', 'followerAccounts'));
    }
}

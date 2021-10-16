<?php

namespace App\Http\Controllers;

use App\Repositories\FollowRepositoryInterface;
use App\Services\UserAuthServiceInterface;

class FollowerController extends Controller
{
    protected $userAuthService;
    protected $followRepository;

    public function __construct(
        UserAuthServiceInterface $userAuthService,
        FollowRepositoryInterface $followRepository
    ) {
        $this->userAuthService  = $userAuthService;
        $this->followRepository = $followRepository;
    }

    public function index(int $userId)
    {
        $myId      = $this->userAuthService->getLoginUserId();

        // NOTE: 自分をfollowしている人を取得
        $followers = $this->followRepository->getByUserToId($myId);
        $followers->load('user_follower');

        return view('MyService.friends-list', compact('myId', 'followers', 'userId'));
    }
}

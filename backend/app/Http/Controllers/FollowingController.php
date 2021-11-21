<?php

namespace App\Http\Controllers;

use App\Repositories\FollowRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Services\UserAuthServiceInterface;

/**
 * 自分がフォローしている人に関するコントローラー
 */
class FollowingController extends Controller
{
    protected $userAuthService;
    protected $userRepository;
    protected $followRepository;

    public function __construct(
        UserAuthServiceInterface $userAuthService,
        UserRepositoryInterface $userRepository,
        FollowRepositoryInterface $followRepository
    ) {
        $this->userAuthService  = $userAuthService;
        $this->userRepository   = $userRepository;
        $this->followRepository = $followRepository;
    }

    public function index(int $userId)
    {
        $myId = $this->userAuthService->getLoginUserId();

        // NOTE: 自分がfollowしている人を取得
        $followings = $this->followRepository->getByUserId($myId);
        $followings->load('user_following');

        return view('MyService.friends-list', compact('myId', 'followings', 'userId'));
    }

    public function follow(int $userId)
    {
        $myId      = $this->userAuthService->getLoginUserId();
        $myAccount = $this->userRepository->findById($myId);

        $myAccount->follow()->attach($userId);
    }

    public function unfollow(int $userId)
    {
        $myId      = $this->userAuthService->getLoginUserId();
        $myAccount = $this->userRepository->findById($myId);

        $myAccount->follow()->detach($userId);
    }
}

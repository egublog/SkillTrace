<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Repositories\UserRepositoryInterface;
use App\Services\UserAuthServiceInterface;
use App\UseCase\FollowingIndexCaseInterface;

/**
 * 自分がフォローしている人に関するコントローラー
 */
class FollowingController extends Controller
{
    protected $userAuthService;
    protected $userRepository;
    protected $followingIndexCase;

    public function __construct(
        UserAuthServiceInterface $userAuthService,
        UserRepositoryInterface $userRepository,
        FollowingIndexCaseInterface $followingIndexCase
    ) {
        $this->userAuthService = $userAuthService;
        $this->userRepository = $userRepository;
        $this->followingIndexCase = $followingIndexCase;
    }

    public function index(int $userId)
    {
        $followings = $this->followingIndexCase->handle($userId);

        return $followings;
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

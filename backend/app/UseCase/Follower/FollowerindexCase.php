<?php

declare(strict_types=1);

namespace App\UseCase\Follower;

use App\Services\UserAuthServiceInterface;
use App\UseCase\FollowerIndexCaseInterface;
use Illuminate\Contracts\View\View;

/**
 * /followers.indexのユースケース
 */
final class FollowerIndexCase implements FollowerIndexCaseInterface
{

    private $userAuthService;
    private $followRepository;

    public function __construct(
        UserAuthServiceInterface $userAuthService,
        FollowRepositoryInterface $followRepository
    ) {
        $this->userAuthService  = $userAuthService;
        $this->followRepository = $followRepository;
    }

    /**
     * /followers.indexのユースケースを実行する
     *
     * @return View
     */
    public function handle(): View
    {
        $myId = $this->userAuthService->getLoginUserId();

        // NOTE: 自分をfollowしている人を取得
        $followers = $this->followRepository->getByUserToId($myId);
        $followers->load('user_follower');

        return view('MyService.friends-list', compact('myId', 'followers', 'userId'));
    }
}

<?php

declare(strict_types=1);

namespace App\UseCase\Following;

use App\Services\UserAuthServiceInterface;
use App\UseCase\FollowingIndexCaseInterface;
use Illuminate\Contracts\View\View;

/**
 * /followings.indexのユースケース
 */
final class FollowingIndexCase implements FollowingIndexCaseInterface
{
    private $userAuthService;
    private $followRepository;

    public function __construct(
        UserAuthServiceInterface $userAuthService,
        FollowRepositoryInterface $followRepository
    ) {
        $this->userAuthService = $userAuthService;
        $this->followRepository = $followRepository;
    }

    /**
     * @param int $userId
     *
     * @return View
     */
    public function handle(int $userId): View
    {
        $myId = $this->userAuthService->getLoginUserId();

        // NOTE: 自分がfollowしている人を取得
        $followings = $this->followRepository->getByUserId($myId);
        $followings->load('user_following');

        return view('MyService.friends-list', compact('myId', 'followings', 'userId'));
    }
}

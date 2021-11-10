<?php

declare(strict_types=1);

namespace App\UseCase\Activity;

use App\UseCase\ActivityIndexCaseInterface;
use Illuminate\Contracts\View\View;

final class ActivityIndexCase implements ActivityIndexCaseInterface
{
    private $followRepository;
    private $userAuthService;

    public function __construct(
        FollowRepositoryInterface $followRepository,
        UserAuthServiceInterface $userAuthService
    ) {
        $this->followRepository = $followRepository;
        $this->userAuthService  = $userAuthService;
    }

    /**
     *
     * @return
     */
    public function handle(): View
    {
        $myId = $this->userAuthService->getLoginUserId();

        // NOTE: 自分をfollowしている人を取得
        $followerAccounts = $this->followRepository->getByUserToId($myId);
        $followerAccounts->load('user_follower');

        return view('MyService.activity', compact('myId', 'followerAccounts'));
    }
}

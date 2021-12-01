<?php

declare(strict_types=1);

namespace App\UseCase\Home;

use App\Repositories\FollowRepositoryInterface;
use App\Repositories\UserLanguageRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Services\UserAuthServiceInterface;
use App\UseCase\HomeHomeCaseInterface;
use Illuminate\Contracts\View\View;

final class HomeHomeCase implements HomeHomeCaseInterface
{
    private $userAuthService;
    private $userRepository;
    private $userLanguageRepository;
    private $followRepository;

    public function __construct(
        UserAuthServiceInterface $userAuthService,
        UserRepositoryInterface $userRepository,
        UserLanguageRepositoryInterface $userLanguageRepository,
        FollowRepositoryInterface $followRepository
    ) {
        $this->userAuthService        = $userAuthService;
        $this->userRepository         = $userRepository;
        $this->userLanguageRepository = $userLanguageRepository;
        $this->followRepository       = $followRepository;
    }

    /**
     * @return View
     */
    public function handle(int $userId): View
    {
        $myId      = $this->userAuthService->getLoginUserId();
        $myAccount = $this->userRepository->findById($myId);

        $languages = $this->userLanguageRepository->findByUserIdAndAscByLanguageId($userId);
        $languages->load('language');

        // TODO: 独自のHomeHomeRequestを作成し、userIdがない場合を考慮する。
        $account = $this->userRepository->findById($userId);

        $followCheck = $this->followRepository->getByUserIdAndUserToId($myId, $userId);

        $this->followRepository->followCheck($followCheck);

        return view('MyService.home', compact('myId', 'myAccount', 'userId', 'account', 'languages', 'followCheck'));
    }
}

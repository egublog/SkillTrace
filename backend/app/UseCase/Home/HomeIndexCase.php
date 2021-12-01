<?php

declare(strict_types=1);

namespace App\UseCase\Home;

use App\Repositories\UserRepositoryInterface;
use App\Services\UserAuthServiceInterface;
use App\UseCase\HomeIndexCaseInterface;
use Illuminate\Contracts\View\View;

/**
 * home.indexのユースケース
 */
final class HomeIndexCase implements HomeIndexCaseInterface
{
    private $userAuthService;
    private $userRepository;

    public function __construct(
        UserAuthServiceInterface $userAuthService,
        UserRepositoryInterface $userRepository
    ) {
        $this->userAuthService = $userAuthService;
        $this->userRepository = $userRepository;
    }

    /**
     * @return View
     */
    public function handle(): View
    {
        $myId    = $this->userAuthService->getLoginUserId();
        $account = $this->userRepository->findById($myId);

        return view('home', compact('myId', 'account'));
    }
}

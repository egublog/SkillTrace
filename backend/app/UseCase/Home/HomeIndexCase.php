<?php

declare(strict_types=1);

namespace App\UseCase\Home;

use App\UseCase\HomeIndexCaseInterface;
use Illuminate\Contracts\View\View;

final class HomeIndexCase implements HomeIndexCaseInterface
{
    private $userAuthService;
    private $userRepository;

    public function __construct(
        UserAuthService $userAuthService,
        UserRepository $userRepository
    ) {
        $this->userAuthService = $userAuthService;
        $this->userRepository = $userRepository;
    }

    public function handle(): View
    {
        $myId    = $this->userAuthService->getLoginUserId();
        $account = $this->userRepository->findById($myId);

        return view('home', compact('myId', 'account'));
    }
}

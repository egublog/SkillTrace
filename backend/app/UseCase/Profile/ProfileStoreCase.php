<?php

declare(strict_types=1);

namespace App\UseCase\Profile;

use App\Repositories\UserRepositoryInterface;
use App\Services\UserAuthServiceInterface;
use App\UseCase\ProfileStoreCaseInterface;
use Illuminate\Http\RedirectResponse;

final class ProfileStoreCase implements ProfileStoreCaseInterface
{
    private $userAuthService;
    private $userRepository;

    public function __construct(
        UserAuthServiceInterface $userAuthService,
        UserRepositoryInterface $userRepository
    ) {
        $this->userAuthService    = $userAuthService;
        $this->userRepository     = $userRepository;
    }

    /**
     * @return RedirectResponse
     */
    public function handle(array $validated): RedirectResponse
    {
        $myId      = $this->userAuthService->getLoginUserId();
        $account   = $this->userRepository->findById($myId);

        $account->update($validated);

        return redirect()->route('home.home', ['userId' => $myId]);
    }
}

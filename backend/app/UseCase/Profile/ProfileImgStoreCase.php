<?php

declare(strict_types=1);

namespace App\UseCase\Profile;

use App\Repositories\UserRepositoryInterface;
use App\Services\UserAuthServiceInterface;
use App\UseCase\ProfileImgStoreCaseInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

final class ProfileImgStoreCase implements ProfileImgStoreCaseInterface
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
     * @param array $validated
     *
     * @return RedirectResponse
     */
    public function handle(array $validated): RedirectResponse
    {
        $userImg   = $validated['profile_img'];

        $myId      = $this->userAuthService->getLoginUserId();
        $myAccount = $this->userRepository->findById($myId);

        $path           = Storage::disk('s3')->putFile('profile_img', $userImg, 'public');
        $myAccount->img = Storage::disk('s3')->url($path);

        $myAccount->save();

        return redirect()->route('profiles.index');
    }
}

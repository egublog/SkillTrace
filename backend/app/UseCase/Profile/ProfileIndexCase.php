<?php

declare(strict_types=1);

namespace App\UseCase\Profile;

use App\Repositories\AreaRepositoryInterface;
use App\Repositories\HistoryRepositoryInterface;
use App\Repositories\LanguageRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Services\UserAuthServiceInterface;
use App\UseCase\ProfileIndexCaseInterface;
use Illuminate\Contracts\View\View;

final class ProfileIndexCase implements ProfileIndexCaseInterface
{
    private $userAuthService;
    private $userRepository;
    private $areaRepository;
    private $historyRepository;
    private $languageRepository;

    public function __construct(
        UserAuthServiceInterface $userAuthService,
        UserRepositoryInterface $userRepository,
        AreaRepositoryInterface $areaRepository,
        HistoryRepositoryInterface $historyRepository,
        LanguageRepositoryInterface $languageRepository
    ) {
        $this->userAuthService    = $userAuthService;
        $this->userRepository     = $userRepository;
        $this->areaRepository     = $areaRepository;
        $this->historyRepository  = $historyRepository;
        $this->languageRepository = $languageRepository;
    }

    /**
     * @return View
     */
    public function handle(): View
    {
        $myId      = $this->userAuthService->getLoginUserId();
        $myAccount = $this->userRepository->findById($myId);
        $area      = $this->areaRepository->getAll();
        $histories = $this->historyRepository->getAll();
        $languages = $this->languageRepository->getAll();

        return view('MyService.profile', compact('myId', 'areas', 'histories', 'languages', 'myAccount'));
    }
}

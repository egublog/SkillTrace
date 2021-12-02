<?php

declare(strict_types=1);

namespace App\UseCase\Search;

use App\Repositories\AreaRepositoryInterface;
use App\Repositories\HistoryRepositoryInterface;
use App\Repositories\LanguageRepositoryInterface;
use App\Services\UserAuthServiceInterface;
use App\UseCase\SearchIndexCaseInterface;
use Illuminate\Contracts\View\View;

/**
 * search.indexのユースケース
 */
final class SearchIndexCase implements SearchIndexCaseInterface
{
    private $userAuthService;
    private $areaRepository;
    private $historyRepository;
    private $languageRepository;

    public function __construct(
        UserAuthServiceInterface $userAuthService,
        AreaRepositoryInterface $areaRepository,
        HistoryRepositoryInterface $historyRepository,
        LanguageRepositoryInterface $languageRepository
    ) {
        $this->userAuthService    = $userAuthService;
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
        $areas     = $this->areRepository->getAll();
        $histories = $this->historyRepository->getAll();
        $languages = $this->languageRepository->getAll();


        return view('MyService.search', compact('myId', 'areas', 'histories', 'languages'));
    }
}

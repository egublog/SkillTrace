<?php

declare(strict_types=1);

namespace App\UseCase\Search;

use App\Queries\SearchUsers;
use App\Repositories\AreaRepositoryInterface;
use App\Repositories\HistoryRepositoryInterface;
use App\Repositories\LanguageRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Services\UserAuthServiceInterface;
use App\UseCase\SearchSearchCaseInterface;
use Illuminate\Contracts\View\View;

/**
 * search.indexのユースケース
 */
final class SearchSearchCase implements SearchSearchCaseInterface
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
        $this->userAuthService = $userAuthService;
        $this->areaRepository = $areaRepository;
        $this->historyRepository = $historyRepository;
        $this->languageRepository = $languageRepository;
    }

    /**
     * @return View
     */
    public function handle(array $validated): View
    {
        $myId      = $this->userAuthService->getLoginUserId();
        $areas     = $this->areaRepository->getAll();
        $histories = $this->historyRepository->getAll();
        $languages = $this->languageRepository->getAll();

        $name = $validated['name'];
        $age = $validated['age'];
        $areaId = $validated['area_id'];
        $historyId = $validated['history_id'];
        $languageId = $validated['language_id'];

        session()->flash();

        $searchResultUsers = SearchUsers::search($myId, $name, $age, $areaId, $historyId, $languageId)->get();

        return view('MyService.search', compact('myId', 'areas', 'histories', 'languages', 'searchResultUsers'));
    }
}

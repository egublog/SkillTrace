<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\History;
use App\Models\Language;
use App\Queries\SearchUsers;
use App\Http\Requests\SearchRequest;
use App\Repositories\AreaRepositoryInterface;
use App\Services\UserAuthServiceInterface;

/**
 * 検索画面コントローラー
 */
class SearchController extends Controller
{
    protected $userAuthService;
    protected $areRepository;
    protected $historyRepository;
    protected $languageRepository;

    public function __construct(
        UserAuthServiceInterface $userAuthService,
        AreaRepositoryInterface $areRepository,
        HistoryRepositoryInterface $historyRepository,
        LanguageRepositoryInterface $languageRepository
    )
    {
        $this->userAuthService = $userAuthService;
        $this->areRepository   = $areRepository;
        $this->historyRepository = $historyRepository;
        $this->languageRepository = $languageRepository;
    }

    public function index()
    {
        $myId      = $this->userAuthService->getLoginUserId();
        $areas     = $this->areRepository->getAll();
        $histories = $this->historyRepository->getAll();
        $languages = $this->languageRepository->getAll();


        return view('MyService.search', compact('myId', 'areas', 'histories', 'languages'));
    }

    public function search(SearchRequest $request)
    {
        $myId      = $this->userAuthService->getLoginUserId();
        $areas     = $this->areRepository->getAll();
        $histories = $this->historyRepository->getAll();
        $languages = $this->languageRepository->getAll();

        $name = $request->input('name');
        $age = $request->input('age');
        $areaId = $request->input('area_id');
        $historyId = $request->input('history_id');
        $languageId = $request->input('language_id');

        $request->flash();

        $searchResultUsers = SearchUsers::search($myId, $name, $age, $areaId, $historyId, $languageId)->get();

        return view('MyService.search', compact('myId', 'areas', 'histories', 'languages', 'searchResultUsers'));
    }
}

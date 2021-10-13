<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\History;
use App\Models\Language;
use App\Queries\SearchUsers;
use App\Http\Requests\SearchRequest;
use App\Services\UserAuthServiceInterface;

class SearchController extends Controller
{
    protected $userAuthService;

    public function __construct(
        UserAuthServiceInterface $userAuthService
    )
    {
        $this->userAuthService = $userAuthService;
    }

    public function index()
    {
        $myId  = $this->userAuthService->getLoginUserId();
        $areas = Area::all();
        $histories = History::all();
        $languages = Language::all();


        return view('MyService.search', compact('myId', 'areas', 'histories', 'languages'));
    }

    public function search(SearchRequest $request)
    {
        $myId  = $this->userAuthService->getLoginUserId();

        $areas = Area::all();
        $histories = History::all();
        $languages = Language::all();

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

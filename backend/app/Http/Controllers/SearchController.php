<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\UseCase\SearchIndexCaseInterface;
use App\UseCase\SearchSearchCaseInterface;

/**
 * 検索画面コントローラー
 */
class SearchController extends Controller
{
    protected $searchIndexCase;
    protected $searchSearchCase;

    public function __construct(
        SearchIndexCaseInterface $searchIndexCase,
        SearchSearchCaseInterface $searchSearchCase
    )
    {
        $this->searchIndexCase  = $searchIndexCase;
        $this->searchSearchCase = $searchSearchCase;
    }

    public function index()
    {
        $index = $this->searchIndexCase->handle();

        return $index;
    }

    public function search(SearchRequest $request)
    {
        $validated = $request->validated();
        $search = $this->searchSearchCase->handle($validated);

        return $search;
    }
}

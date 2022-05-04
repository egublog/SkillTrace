<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\UseCase\SearchIndexCaseInterface;
use App\UseCase\SearchSearchCaseInterface;
use Illuminate\Contracts\View\View;

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

    public function index(): View
    {
        $index = $this->searchIndexCase->handle();

        return $index;
    }

    public function search(SearchRequest $request): View
    {
        $validated = $request->validated();
        $search = $this->searchSearchCase->handle($validated);

        return $search;
    }
}

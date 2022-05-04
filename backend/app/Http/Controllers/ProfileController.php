<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ProfileImageStoreRequest;
use App\Http\Requests\ProfileStoreRequest;
use App\UseCase\ProfileImgStoreCaseInterface;
use App\UseCase\ProfileIndexCaseInterface;
use App\UseCase\ProfileStoreCaseInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * プロフィール画面に関するコントローラー
 */
class ProfileController extends Controller
{
    protected $profileIndexCase;
    protected $profileStoreCase;
    protected $profileImgStoreCase;

    public function __construct(
        ProfileIndexCaseInterface $profileIndexCase,
        ProfileStoreCaseInterface $profileStoreCase,
        ProfileImgStoreCaseInterface $profileImgStoreCase
    )
    {
        $this->profileIndexCase    = $profileIndexCase;
        $this->profileStoreCase    = $profileStoreCase;
        $this->profileImgStoreCase = $profileImgStoreCase;
    }

    public function index(): View
    {
        $index = $this->profileIndexCase->handle();

        return $index;
    }

    public function store(ProfileStoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $store = $this->profileStoreCase->handle($validated);

        return $store;
    }

    public function img_store(ProfileImageStoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $imgStore  = $this->profileImgStoreCase->handle($validated);

        return $imgStore;
    }
}

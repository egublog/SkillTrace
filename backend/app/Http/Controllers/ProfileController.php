<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\ProfileImageRequest;
use App\Models\Area;
use App\Models\History;
use App\Models\Language;
use App\Repositories\AreaRepositoryInterface;
use App\Repositories\LanguageRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Services\UserAuthServiceInterface;
use App\UseCase\ProfileIndexCaseInterface;

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

    public function index()
    {
        $index = $this->profileIndexCase->handle();

        return $index;
    }

    public function store(ProfileRequest $request)
    {
        $validated = $request->validated();
        $store = $this->profileStoreCase->handle($validated);

        return $store;
    }

    public function img_store(ProfileImageRequest $request)
    {
        $validated = $request->validated();
        $imgStore  = $this->profileImgStoreCase->handle($validated);

        return $imgStore;
    }
}

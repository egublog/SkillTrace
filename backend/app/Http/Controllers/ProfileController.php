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

/**
 * プロフィール画面に関するコントローラー
 */
class ProfileController extends Controller
{
    protected $userAuthService;
    protected $userRepository;
    protected $areaRepository;
    protected $historyRepository;
    protected $languageRepository;

    public function __construct(
        UserAuthServiceInterface $userAuthService,
        UserRepositoryInterface $userRepository,
        AreaRepositoryInterface $areaRepository,
        HistoryRepositoryInterface $historyRepository,
        LanguageRepositoryInterface $languageRepository
    )
    {
        $this->userAuthService    = $userAuthService;
        $this->userRepository     = $userRepository;
        $this->areaRepository     = $areaRepository;
        $this->historyRepository  = $historyRepository;
        $this->languageRepository = $languageRepository;
    }

    public function index()
    {
        $myId      = $this->userAuthService->getLoginUserId();
        $myAccount = $this->userRepository->findById($myId);
        $area      = $this->areaRepository->getAll();
        $histories = $this->historyRepository->getAll();
        $languages = $this->languageRepository->getAll();

        return view('MyService.profile', compact('myId', 'areas', 'histories', 'languages', 'myAccount'));
    }

    public function store(ProfileRequest $request)
    {
        $validated = $request->validated();
        $myId      = $this->userAuthService->getLoginUserId();
        $account   = $this->userRepository->findById($myId);

        $account->update($validated);

        return redirect()->route('home.home', ['userId' => $myId]);
    }

    public function img_store(ProfileImageRequest $request)
    {
        $validated = $request->validated();
        $userImg   = $validated['profile_img'];

        $myId      = $this->userAuthService->getLoginUserId();
        $myAccount = $this->userRepository->findById($myId);

        $path           = Storage::disk('s3')->putFile('profile_img', $userImg, 'public');
        $myAccount->img = Storage::disk('s3')->url($path);

        $myAccount->save();

        return redirect()->route('profiles.index');
    }
}

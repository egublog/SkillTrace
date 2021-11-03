<?php

namespace App\Http\Controllers;

use App\Http\Requests\SkillRequest;
use App\Models\Language;
use App\Models\UserLanguage;
use App\Models\Trace;
use App\Models\Ability;
use App\Repositories\UserLanguageRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Services\UserAuthServiceInterface;

class SkillController extends Controller
{
    protected $userAuthService;
    protected $userRepository;
    protected $userLanguageRepository;
    protected $traceRepository;

    public function __construct(
        UserAuthServiceInterface $userAuthService,
        UserRepositoryInterface $userRepository,
        UserLanguageRepositoryInterface $userLanguageRepository,
        TraceRepositoryInterface $traceRepository
    )
    {
        $this->userAuthService        = $userAuthService;
        $this->userRepository         = $userRepository;
        $this->userLanguageRepository = $userLanguageRepository;
        $this->traceRepository        = $traceRepository;
    }

    public function show(int $userId, int $skillId)
    {
        $myId     = $this->userAuthService->getLoginUserId();

        // FIXME: findByUserIdAndLanguageId()の第二引数は命名規則に則るなら、$languageIdだが、後方互換性のために$skillIdにしている。後々$languageIdにリファクタする
        $theSkill = $this->userLanguageRepository->findByUserIdAndLanguageId($userId, $skillId);

        $userLanguageId = $theSkill->id;

        $account = $this->userRepository->findById($userId);

        $traces = $this->traceRepository->getByUserLanguageId($userLanguageId);
        $abilities = Ability::where('user_language_id', $userLanguageId)->get();

        return view('MyService.skill-item', compact('theSkill', 'traces', 'abilities', 'myId', 'account', 'skillId', 'userLanguageId', 'userId'));
    }

    public function create()
    {
        $myId     = $this->userAuthService->getLoginUserId();

        $userLanguages = $this->userLanguageRepository->findByUserIdAndGetLanguageId($myId);

        $languages = Language::whereNotIn('id', $userLanguages)->get();


        return view('MyService.skill-add', compact('myId', 'languages'));
    }

    public function store(SkillRequest $request)
    {
        $myId          = $this->userAuthService->getLoginUserId();
        $theLanguageId = $request->language_id;

        $userLanguage = new UserLanguage;
        $userLanguage->user_id = $myId;
        $userLanguage->language_id = $theLanguageId;
        $userLanguage->star_count = 1;
        $userLanguage->save();

        return redirect()->route('home.home', ['userId' => $myId]);
    }

    public function destroy(int $userLanguageId)
    {
        $userLanguage = $this->userLanguageRepository->findById($userLanguageId);
        $this->userLanguageRepository->delete($userLanguage->toArray());

        $myId = $this->userAuthService->getLoginUserId();

        return redirect()->route('home.home', ['userId' => $myId]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\SkillRequest;
use App\Models\UserLanguage;
use App\Repositories\UserLanguageRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Services\UserAuthServiceInterface;

/**
 * スキルを登録するコントローラー
 */
class SkillController extends Controller
{
    protected $userAuthService;
    protected $userRepository;
    protected $userLanguageRepository;
    protected $traceRepository;
    protected $abilityRepository;
    protected $languageRepository;

    public function __construct(
        UserAuthServiceInterface $userAuthService,
        UserRepositoryInterface $userRepository,
        UserLanguageRepositoryInterface $userLanguageRepository,
        TraceRepositoryInterface $traceRepository,
        AbilityRepositoryInterface $abilityRepository,
        LanguageRepositoryInterface $languageRepository
    )
    {
        $this->userAuthService        = $userAuthService;
        $this->userRepository         = $userRepository;
        $this->userLanguageRepository = $userLanguageRepository;
        $this->traceRepository        = $traceRepository;
        $this->abilityRepository      = $abilityRepository;
        $this->languageRepository     = $languageRepository;
    }

    public function show(int $userId, int $skillId)
    {
        $myId     = $this->userAuthService->getLoginUserId();

        // FIXME: findByUserIdAndLanguageId()の第二引数は命名規則に則るなら、$languageIdだが、後方互換性のために$skillIdにしている。後々$languageIdにリファクタする
        $theSkill = $this->userLanguageRepository->findByUserIdAndLanguageId($userId, $skillId);

        $userLanguageId = $theSkill->id;

        $account = $this->userRepository->findById($userId);

        $traces = $this->traceRepository->getByUserLanguageId($userLanguageId);
        $abilities = $this->abilityRepository->getByUserLanguageId($userLanguageId);

        return view('MyService.skill-item', compact('theSkill', 'traces', 'abilities', 'myId', 'account', 'skillId', 'userLanguageId', 'userId'));
    }

    public function create()
    {
        $myId     = $this->userAuthService->getLoginUserId();

        $userLanguages = $this->userLanguageRepository->findByUserIdAndGetLanguageId($myId);

        $languages =$this->languageRepository->getWhereNotIn($userLanguages);

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

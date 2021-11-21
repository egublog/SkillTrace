<?php

namespace App\Http\Controllers;

use App\Http\Requests\SkillStarRequest;
use App\Repositories\UserLanguageRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Services\UserAuthServiceInterface;

/**
 * スキルの星を登録するコントローラー
 */
class SkillStarController extends Controller
{
    protected $userAuthService;
    protected $userRepository;
    protected $userLanguageRepository;

    public function __construct(
        UserAuthServiceInterface $userAuthService,
        UserRepositoryInterface $userRepository,
        UserLanguageRepositoryInterface $userLanguageRepository
    )
    {
        $this->userAuthService        = $userAuthService;
        $this->userRepository         = $userRepository;
        $this->userLanguageRepository = $userLanguageRepository;
    }

    public function create(int $userLanguageId)
    {
        $myId     = $this->userAuthService->getLoginUserId();
        $theSkill = $this->userLanguageRepository->findById($userLanguageId);

        //区別するためにstarsを用意
        $stars = $this->userLanguageRepository->findById($userLanguageId);

        return view('MyService.skill-edit', compact('myId', 'theSkill', 'userLanguageId', 'stars'));
    }

    public function update(int $userLanguageId, SkillStarRequest $request)
    {
        $stars = $request->input('star_count');

        $theSkill = $this->userLanguageRepository->findById($userLanguageId);
        $theSkill->star_count = $stars;
        $theSkill->save();

        $account = $this->userRepository->findById($theSkill->user_id);

        $userId = $account->id;
        $skillId = $theSkill->language_id;

        return redirect()->route('skills.show', ['userId' => $userId, 'skillId' => $skillId]);
    }
}

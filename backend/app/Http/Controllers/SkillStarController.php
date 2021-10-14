<?php

namespace App\Http\Controllers;

use App\Http\Requests\SkillStarRequest;
use App\Models\User;
use App\Models\UserLanguage;
use App\Repositories\UserRepositoryInterface;
use App\Services\UserAuthServiceInterface;

class SkillStarController extends Controller
{
    protected $userAuthService;
    protected $userRepository;

    public function __construct(
        UserAuthServiceInterface $userAuthService,
        UserRepositoryInterface $userRepository
    )
    {
        $this->userAuthService = $userAuthService;
        $this->userRepository  = $userRepository;
    }

    public function create(int $userLanguageId)
    {
        $myId     = $this->userAuthService->getLoginUserId();
        $theSkill = UserLanguage::find($userLanguageId);

        //区別するためにstarsを用意
        $stars = UserLanguage::find($userLanguageId);

        return view('MyService.skill-edit', compact('myId', 'theSkill', 'userLanguageId', 'stars'));
    }

    public function update(int $userLanguageId, SkillStarRequest $request)
    {
        $stars = $request->input('star_count');

        $theSkill = UserLanguage::find($userLanguageId);
        $theSkill->star_count = $stars;
        $theSkill->save();

        $account = $this->userRepository->findById($theSkill->user_id);

        $userId = $account->id;
        $skillId = $theSkill->language_id;

        return redirect()->route('skills.show', ['userId' => $userId, 'skillId' => $skillId]);
    }
}

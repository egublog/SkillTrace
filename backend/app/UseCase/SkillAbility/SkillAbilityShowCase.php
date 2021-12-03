<?php

declare(strict_types=1);

namespace App\UseCase\SkillAbility;

use App\Repositories\AbilityRepositoryInterface;
use App\Repositories\UserLanguageRepositoryInterface;
use App\Services\UserAuthServiceInterface;
use App\UseCase\SkillAbilityShowCaseInterface;
use Illuminate\Contracts\View\View;

final class SkillAbilityShowCase implements SkillAbilityShowCaseInterface
{

    private $userAuthService;
    private $userLanguageRepository;
    private $abilityRepository;

    public function __construct(
        UserAuthServiceInterface $userAuthService,
        UserLanguageRepositoryInterface $userLanguageRepository,
        AbilityRepositoryInterface $abilityRepository
    ) {
        $this->userAuthService        = $userAuthService;
        $this->userLanguageRepository = $userLanguageRepository;
        $this->abilityRepository      = $abilityRepository;
    }

    /**
     * @param int $userLanguageId
     * @param int $abilityId
     *
     * @return View
     */
    public function handle(int $userLanguageId, int $abilityId): View
    {
        $myId     = $this->userAuthService->getLoginUserId();
        $theSkill = $this->userLanguageRepository->findById($userLanguageId);
        $abilityEdit = $this->abilityRepository->findById($abilityId);

        return view('MyService.skill-edit', compact('myId', 'theSkill', 'abilityEdit', 'abilityId', 'userLanguageId'));
    }
}

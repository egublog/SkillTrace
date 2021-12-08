<?php

declare(strict_types=1);

namespace App\UseCase\SkillAbility;

use App\Repositories\AbilityRepositoryInterface;
use App\Repositories\UserLanguageRepositoryInterface;
use App\Services\UserAuthServiceInterface;
use App\UseCase\SkillAbilityCreateCaseInterface;
use Illuminate\Contracts\View\View;

/**
 * skill_abilities.createのユースケース
 */
final class SkillAbilityCreateCase implements SkillAbilityCreateCaseInterface
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
     *
     * @return View
     */
    public function handle(int $userLanguageId): View
    {
        $myId     = $this->userAuthService->getLoginUserId();
        $theSkill = $this->userLanguageRepository->findById($userLanguageId);

        $abilities = $this->abilityRepository->getByUserLanguageId($userLanguageId);

        return view('MyService.skill-edit', compact('myId', 'theSkill', 'userLanguageId', 'abilities'));
    }
}

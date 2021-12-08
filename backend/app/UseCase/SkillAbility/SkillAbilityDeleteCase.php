<?php

declare(strict_types=1);

namespace App\UseCase\SkillAbility;

use App\Repositories\AbilityRepositoryInterface;
use App\Repositories\UserLanguageRepositoryInterface;
use App\UseCase\SkillAbilityDeleteCaseInterface;
use Illuminate\Http\RedirectResponse;

/**
 * skill_abilities.deleteのユースケース
 */
final class SkillAbilityDeleteCase implements SkillAbilityDeleteCaseInterface
{

    private $userRepository;
    private $userLanguageRepository;
    private $abilityRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        UserLanguageRepositoryInterface $userLanguageRepository,
        AbilityRepositoryInterface $abilityRepository
    ) {
        $this->userRepository         = $userRepository;
        $this->userLanguageRepository = $userLanguageRepository;
        $this->abilityRepository      = $abilityRepository;
    }

    /**
     * @param int $userLanguageId
     * @param int $abilityId
     *
     * @return RedirectResponse
     */
    public function handle(int $userLanguageId, int $abilityId): RedirectResponse
    {
        $theSkill = $this->userLanguageRepository->findById($userLanguageId);
        $account = $this->userRepository->findById($theSkill->user_id);

        $userId = $account->id;
        $skillId = $theSkill->language_id;

        $ability = $this->abilityRepository->findById($abilityId);

        $this->abilityRepository->delete((array) $ability);

        return redirect()->route('skills.show', ['userId' => $userId, 'skillId' => $skillId]);
    }
}

<?php

declare(strict_types=1);

namespace App\UseCase\SkillAbility;

use App\Repositories\AbilityRepositoryInterface;
use App\Repositories\UserLanguageRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\UseCase\SkillAbilityUpdateCaseInterface;
use Illuminate\Http\RedirectResponse;

final class SkillAbilityUpdateCase implements SkillAbilityUpdateCaseInterface
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
     * @param array $validated
     *
     * @return RedirectResponse
     */
    public function handle(int $userLanguageId, int $abilityId, array $validated): RedirectResponse
    {
        $abilityText = $validated['ability'];

        $abilityEdit = $this->abilityRepository->findById($abilityId);

        $abilityEdit->content = $abilityText;
        $abilityEdit->save();

        $theSkill = $this->userLanguageRepository->findById($userLanguageId);
        $account = $this->userRepository->findById($theSkill->user_id);

        $userId = $account->id;
        $skillId = $theSkill->language_id;

        return redirect()->route('skills.show', ['userId' => $userId, 'skillId' => $skillId]);
    }
}

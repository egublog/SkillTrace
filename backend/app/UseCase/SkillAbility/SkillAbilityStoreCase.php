<?php

declare(strict_types=1);

namespace App\UseCase\SkillAbility;

use App\Repositories\AbilityRepositoryInterface;
use App\Repositories\UserLanguageRepositoryInterface;
use App\Services\UserAuthServiceInterface;
use App\UseCase\SkillAbilityStoreCaseInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * skill_abilities.storeのユースケース
 */
final class SkillAbilityStoreCase implements SkillAbilityStoreCaseInterface
{
    private $userLanguageRepository;

    public function __construct(
        UserLanguageRepositoryInterface $userLanguageRepository
    ) {
        $this->userLanguageRepository = $userLanguageRepository;
    }

    /**
     * @param array $validated
     *
     * @return RedirectResponse
     */
    public function handle(int $userLanguageId, array $validated): RedirectResponse
    {
        $ableText = $validated['ability'];

        $skill = new Ability;
        $skill->user_language_id = $userLanguageId;
        $skill->content = $ableText;
        $skill->save();

        $theSkill = $this->userLanguageRepository->findById($userLanguageId);

        $userId = $theSkill->user_id;
        $skillId = $theSkill->language_id;

        return redirect()->route('skills.show', ['userId' => $userId, 'skillId' => $skillId]);
    }
}

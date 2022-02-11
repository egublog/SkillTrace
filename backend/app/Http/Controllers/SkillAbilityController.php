<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\SkillAbilityRequest;
use App\UseCase\SkillAbilityCreateCaseInterface;
use App\UseCase\SkillAbilityStoreCaseInterface;

/**
 * ユーザーのできることを登録するコントローラー
 */
class SkillAbilityController extends Controller
{
    protected $skillAbilityCreateCase;
    protected $skillAbilityStoreCase;
    protected $skillAbilityShowCase;
    protected $skillAbilityUpdateCase;
    protected $skillAbilityDeleteCase;

    public function __construct(
        SkillAbilityCreateCaseInterface $skillAbilityCreateCase,
        SkillAbilityStoreCaseInterface $skillAbilityStoreCase,
        SkillAbilityShowCaseInterface $skillAbilityShowCase,
        SkillAbilityUpdateCaseInterface $skillAbilityUpdateCase,
        SkillAbilityDeleteCaseInterface $skillAbilityDeleteCase
    )
    {
        $this->skillAbilityCreateCase = $skillAbilityCreateCase;
        $this->skillAbilityStoreCase  = $skillAbilityStoreCase;
        $this->skillAbilityShowCase   = $skillAbilityShowCase;
        $this->skillAbilityUpdateCase = $skillAbilityUpdateCase;
        $this->skillAbilityDeleteCase = $skillAbilityDeleteCase;
    }

    public function create(int $userLanguageId)
    {
        $skillAbility = $this->skillAbilityCreateCase->handle($userLanguageId);

        return $skillAbility;
    }

    public function store(int $userLanguageId, SkillAbilityRequest $request)
    {
        $validated = $request->validated();
        $skillAbility = $this->skillAbilityStoreCase->handle($userLanguageId, $validated);

        return $skillAbility;
    }

    public function show(int $userLanguageId, int $abilityId)
    {
        $skillAbility = $this->skillAbilityShowCase->handle($userLanguageId, $abilityId);

        return $skillAbility;
    }

    public function update(int $userLanguageId, int $abilityId, SkillAbilityRequest $request)
    {
        $validated = $request->validated();
        $skillAbility = $this->skillAbilityUpdateCase->handle($userLanguageId, $abilityId, $validated);

        return $skillAbility;
    }

    public function destroy(int $userLanguageId, int $abilityId)
    {
        $skillAbility = $this->skillAbilityDeleteCase->handle($userLanguageId, $abilityId);

        return $skillAbility;
    }
}

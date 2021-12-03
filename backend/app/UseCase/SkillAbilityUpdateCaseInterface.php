<?php
namespace App\UseCase;

use Illuminate\Http\RedirectResponse;

interface SkillAbilityUpdateCaseInterface
{
    public function handle(int $userLanguageId, int $abilityId, array $validated): RedirectResponse;
}

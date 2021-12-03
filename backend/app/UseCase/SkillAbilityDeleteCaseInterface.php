<?php
namespace App\UseCase;

use Illuminate\Http\RedirectResponse;

interface SkillAbilityDeleteCaseInterface
{
    public function handle(int $userLanguageId, int $abilityId): RedirectResponse;
}

<?php
namespace App\UseCase;

use Illuminate\Contracts\View\View;

interface SkillAbilityShowCaseInterface
{
    public function handle(int $userLanguageId, int $abilityId): View;
}

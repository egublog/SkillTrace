<?php
namespace App\UseCase;

use Illuminate\Http\RedirectResponse;

interface SkillAbilityStoreCaseInterface
{
    public function handle(int $userLanguageId, array $validated): RedirectResponse;
}

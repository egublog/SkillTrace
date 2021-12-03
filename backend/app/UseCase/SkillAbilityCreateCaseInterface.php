<?php
namespace App\UseCase;

use Illuminate\Contracts\View\View;

interface SkillAbilityCreateCaseInterface
{
    public function handle(int $userLanguageId): View;
}

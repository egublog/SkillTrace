<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserLanguage;
use App\Models\Ability;
use App\Http\Requests\SkillAbilityRequest;

class SkillAbilityController extends Controller
{
    //
    public function create(int $userLanguageId)
    {
        $myId = Auth::id();
        $theSkill = UserLanguage::find($userLanguageId);

        $abilities = Ability::where('user_language_id', $userLanguageId)->get();

        return view('MyService.skill-edit', compact('myId', 'theSkill', 'userLanguageId', 'abilities'));
    }

    public function store(int $userLanguageId, SkillAbilityRequest $request)
    {
        $ableText = $request->input('ability');

        $skill = new Ability;
        $skill->user_language_id = $userLanguageId;
        $skill->content = $ableText;
        $skill->save();

        $theSkill = UserLanguage::find($userLanguageId);

        $userId = $theSkill->user_id;
        $skillId = $theSkill->language_id;

        return redirect()->route('skills.show', ['userId' => $userId, 'skillId' => $skillId]);
    }

    public function show(int $userLanguageId, int $abilityId)
    {
        $myId = Auth::id();
        $theSkill = UserLanguage::find($userLanguageId);
        $abilityEdit = Ability::find($abilityId);

        return view('MyService.skill-edit', compact('myId', 'theSkill', 'abilityEdit', 'abilityId', 'userLanguageId'));
    }

    public function update(int $userLanguageId, int $abilityId, SkillAbilityRequest $request)
    {
        $abilityText = $request->input('ability');

        $abilityEdit = Ability::find($abilityId);

        $abilityEdit->content = $abilityText;
        $abilityEdit->save();

        $theSkill = UserLanguage::find($userLanguageId);
        $account = User::find($theSkill->user_id);

        $userId = $account->id;
        $skillId = $theSkill->language_id;

        return redirect()->route('skills.show', ['userId' => $userId, 'skillId' => $skillId]);
    }

    public function destroy(int $userLanguageId, int $abilityId)
    {

        $theSkill = UserLanguage::find($userLanguageId);
        $account = User::find($theSkill->user_id);

        $userId = $account->id;
        $skillId = $theSkill->language_id;

        Ability::find($abilityId)->delete();

        return redirect()->route('skills.show', ['userId' => $userId, 'skillId' => $skillId]);
    }
}

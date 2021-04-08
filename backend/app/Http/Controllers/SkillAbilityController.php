<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserLanguage;
use App\Models\Skill;
use App\Http\Requests\SkillAbilityRequest;

class SkillAbilityController extends Controller
{
    //
    public function create($userLanguageId)
    {
        $myId = Auth::id();
        $theSkill = UserLanguage::find($userLanguageId);

        $skillables = Skill::where('user_language_id', $userLanguageId)->get();

        return view('MyService.skill-edit', compact('myId', 'theSkill', 'userLanguageId', 'skillables'));
    }

    public function store($userLanguageId, SkillAbilityRequest $request)
    {
        $ableText = $request->input('ability');

        $skill = new Skill;
        $skill->user_language_id = $userLanguageId;
        $skill->content = $ableText;
        $skill->save();

        $theSkill = UserLanguage::find($userLanguageId);

        $userId = $theSkill->user_id;
        $skillId = $theSkill->language_id;

        return redirect()->route('skills.show', ['userId' => $userId, 'skillId' => $skillId]);
    }

    public function show($userLanguageId, $abilityId)
    {
        $myId = Auth::id();
        $theSkill = UserLanguage::find($userLanguageId);
        $skillableEdits = Skill::find($abilityId);

        return view('MyService.skill-edit', compact('myId', 'theSkill', 'skillableEdits', 'abilityId', 'userLanguageId'));
    }

    public function update($userLanguageId, $abilityId, SkillAbilityRequest $request)
    {
        $skillContent = $request->input('ability');

        $skillableEdits = Skill::find($abilityId);

        $skillableEdits->content = $skillContent;
        $skillableEdits->save();

        $theSkill = UserLanguage::find($userLanguageId);
        $account = User::find($theSkill->user_id);

        $userId = $account->id;
        $skillId = $theSkill->language_id;

        return redirect()->route('skills.show', ['userId' => $userId, 'skillId' => $skillId]);
    }

    public function destroy($userLanguageId, $abilityId)
    {

        $theSkill = UserLanguage::find($userLanguageId);
        $account = User::find($theSkill->user_id);

        $userId = $account->id;
        $skillId = $theSkill->language_id;

        Skill::find($abilityId)->delete();

        return redirect()->route('skills.show', ['userId' => $userId, 'skillId' => $skillId]);
    }
}

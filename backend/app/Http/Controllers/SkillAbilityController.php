<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\User_language;
use App\Models\Skill;

class SkillAbilityController extends Controller
{
    //
    public function create($userLanguageId)
    {
        $myId = Auth::id();
        $theSkill = User_language::find($userLanguageId);

        $skillables = Skill::where('user_language_id', $userLanguageId)->get();

        return view('MyService.skill-edit', compact('myId', 'theSkill', 'userLanguageId', 'skillables'));
    }

    public function store($userLanguageId, Request $request)
    {
        $ableText = $request->input('able');

        $skill = new Skill;
        $skill->user_language_id = $userLanguageId;
        $skill->content = $ableText;
        $skill->save();

        $theSkill = User_language::find($userLanguageId);
        $account = User::find($theSkill->user_id);

        $userId = $account->id;
        $skillId = $theSkill->language_id;

        return redirect()->route('skills.show', ['userId' => $userId, 'skillId' =>$skillId ]);
    }

    public function show($userLanguageId, $abilityId)
    {
        $myId = Auth::id();
        $theSkill = User_language::find($userLanguageId);
        $skillableEdits = Skill::find($abilityId);

        return view('MyService.skill-edit', compact('myId', 'theSkill', 'skillableEdits', 'abilityId', 'userLanguageId'));
    }

    public function update($userLanguageId, $abilityId, Request $request)
    {
        $skill_content = $request->input('skill_content');

        $skillableEdits = Skill::find($abilityId);

        $skillableEdits->content = $skill_content;
        $skillableEdits->save();
        
        $theSkill = User_language::find($userLanguageId);
        $account = User::find($theSkill->user_id);

        $userId = $account->id;
        $skillId = $theSkill->language_id;

        return redirect()->route('skills.show', ['userId' => $userId, 'skillId' =>$skillId ]);
    }

    public function destroy($userLanguageId, $abilityId)
    {

        $theSkill = User_language::find($userLanguageId);
        $account = User::find($theSkill->user_id);

        $userId = $account->id;
        $skillId = $theSkill->language_id;

        Skill::find($abilityId)->delete();

        return redirect()->route('skills.show', ['userId' => $userId, 'skillId' => $skillId ]);
    }
}

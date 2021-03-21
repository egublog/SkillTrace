<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Language;
use App\Models\User;
use App\Models\User_language;
use App\Models\Category;
use App\Models\Trace;
use App\Models\Skill;

class SkillAbilityController extends Controller
{
    //
    public function add($userLanguageId)
    {
        $myId = Auth::id();
        $theSkill = User_language::find($userLanguageId);

        $skillables = Skill::where('user_language_id', $userLanguageId)->get();

        return view('MyService.skill_edit', compact('myId', 'theSkill', 'userLanguageId', 'skillables'));
    }

    public function store($userLanguageId, Request $request)
    {
        $ableText = $request->input('able');

        $myId = Auth::id();

        $skill = new Skill;
        $skill->user_language_id = $userLanguageId;
        $skill->content = $ableText;
        $skill->save();

        $theSkill = User_language::find($userLanguageId);
        $account = User::find($theSkill->user_id);

        $userId = $account->id;
        $skillId = $theSkill->language_id;

        $skillables = Skill::where('user_language_id', $userLanguageId)->get();
        $traces = Trace::where('user_language_id', $userLanguageId)->get();
        $skills = Skill::where('user_language_id', $userLanguageId)->get();

        return redirect()->route('skill.show', ['userId' => $userId, 'skillId' =>$skillId ]);
        
        
        // ->with([
        //     'theSkill' => $theSkill,
        //     'traces' => $traces,
        //     'skills' => $skills,
        //     'myId' => $myId,
        //     'account' => $account
        // ]);;

        // return view('MyService.skill_item')->with([
        //     'theSkill' => $theSkill,
        //     'traces' => $traces,
        //     'skills' => $skills,
        //     'myId' => $myId,
        //     'account' => $account
        // ]);
    }





    public function show($userLanguageId, $abilityId)
    {
        $myId = Auth::id();

        $theSkill = User_language::find($userLanguageId);

        $skillableEdits = Skill::find($abilityId);

        return view('MyService.skill_edit', compact('myId', 'theSkill', 'skillableEdits', 'abilityId', 'userLanguageId'));
    }

    public function update($userLanguageId, $abilityId, Request $request)
    {
        // skillのcontent
        $skill_content = $request->input('skill_content');

        $skillableEdits = Skill::find($abilityId);

        $skillableEdits->content = $skill_content;
        $skillableEdits->save();

        
        $theSkill = User_language::find($userLanguageId);
        $myId = Auth::id();
        $account = User::find($theSkill->user_id);

        $userId = $account->id;
        $skillId = $theSkill->language_id;

        $traces = Trace::where('user_language_id', $userLanguageId)->get();
        $skills = Skill::where('user_language_id', $userLanguageId)->get();

        return redirect()->route('skill.show', ['userId' => $userId, 'skillId' =>$skillId ]);
        
        // ->with([
        //     'theSkill' => $theSkill,
        //     'traces' => $traces,
        //     'skills' => $skills,
        //     'myId' => $myId,
        //     'account' => $account
        // ]);;

        // return view('MyService.skill_item')->with([
        //     'theSkill' => $theSkill,
        //     'traces' => $traces,
        //     'skills' => $skills,
        //     'myId' => $myId,
        //     'account' => $account
        // ]);
    }

    public function destroy($userLanguageId, $abilityId)
    {

        $theSkill = User_language::find($userLanguageId);
        $myId = Auth::id();
        $account = User::find($theSkill->user_id);

        $userId = $account->id;
        $skillId = $theSkill->language_id;

        $skillableDelete = Skill::find($abilityId)->delete();

        $traces = Trace::where('user_language_id', $userLanguageId)->get();
        $skills = Skill::where('user_language_id', $userLanguageId)->get();

        return redirect()->route('skill.show', ['userId' => $userId, 'skillId' => $skillId ]);
        
        // ->with([
        //     'theSkill' => $theSkill,
        //     'traces' => $traces,
        //     'skills' => $skills,
        //     'myId' => $myId,
        //     'account' => $account
        // ]);;

        // return view('MyService.skill_item')->with([
        //     'theSkill' => $theSkill,
        //     'traces' => $traces,
        //     'skills' => $skills,
        //     'myId' => $myId,
        //     'account' => $account
        // ]);
    }

}

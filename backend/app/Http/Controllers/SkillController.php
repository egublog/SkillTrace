<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Language;
use App\Models\User;
use App\Models\User_language;
use App\Models\Trace;
use App\Models\Skill;




class SkillController extends Controller
{
    //
    public function show($userId, $skillId)
    {

        $myId = Auth::id();

        $theSkill = User_language::where('language_id', $skillId)->where('user_id', $userId)->first();

        $userLanguageId = $theSkill->id;

        $account = User::find($userId);

        $traces = Trace::where('user_language_id', $userLanguageId)->get();
        $skills = Skill::where('user_language_id', $userLanguageId)->get();

        return view('MyService.skill_item', compact('theSkill', 'traces', 'skills', 'myId', 'account', 'skillId', 'userLanguageId', 'userId'));
    }

    public function create()
    {
        $myId = Auth::id();

        $user_languages = User_language::where('user_id', $myId)->get(['language_id']);

        $languages = Language::whereNotIn('id', $user_languages)->get();


        return view('MyService.skill_add', compact('myId', 'languages'));
    }

    public function store(Request $request)
    {
        $myId = Auth::id();
        $the_skill = $request->language_id;

        $user_language = new User_language;
        $user_language->user_id = $myId;
        $user_language->language_id = $the_skill;
        $user_language->star_count = 1;
        $user_language->save();

        return redirect()->route('home.home', ['userId' => $myId]);
        
    }

    public function destroy($userLanguageId)
    {
        User_language::find($userLanguageId)->delete();

        $myId = Auth::id();

        return redirect()->route('home.home', ['userId' => $myId]);
    }
}

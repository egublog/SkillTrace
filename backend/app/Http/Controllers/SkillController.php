<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Language;
use App\Models\User;
use App\Models\UserLanguage;
use App\Models\Trace;
use App\Models\Ability;




class SkillController extends Controller
{
    //
    public function show($userId, $skillId)
    {

        $myId = Auth::id();

        $theSkill = UserLanguage::where('language_id', $skillId)->where('user_id', $userId)->first();

        $userLanguageId = $theSkill->id;

        $account = User::find($userId);

        $traces = Trace::where('user_language_id', $userLanguageId)->get();
        $abilities = Ability::where('user_language_id', $userLanguageId)->get();

        return view('MyService.skill-item', compact('theSkill', 'traces', 'abilities', 'myId', 'account', 'skillId', 'userLanguageId', 'userId'));
    }

    public function create()
    {
        $myId = Auth::id();

        $userLanguages = UserLanguage::where('user_id', $myId)->get(['language_id']);

        $languages = Language::whereNotIn('id', $userLanguages)->get();


        return view('MyService.skill-add', compact('myId', 'languages'));
    }

    public function store(Request $request)
    {
        $myId = Auth::id();
        $theSkill = $request->language_id;

        $userLanguage = new UserLanguage;
        $userLanguage->user_id = $myId;
        $userLanguage->language_id = $theSkill;
        $userLanguage->star_count = 1;
        $userLanguage->save();

        return redirect()->route('home.home', ['userId' => $myId]);
    }

    public function destroy($userLanguageId)
    {
        UserLanguage::find($userLanguageId)->delete();

        $myId = Auth::id();

        return redirect()->route('home.home', ['userId' => $myId]);
    }
}

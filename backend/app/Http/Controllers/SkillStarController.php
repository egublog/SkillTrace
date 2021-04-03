<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserLanguage;

class SkillStarController extends Controller
{

    public function create($userLanguageId)
    {
        $myId = Auth::id();
        $theSkill = UserLanguage::find($userLanguageId);

        //区別するためにstarsを用意
        $stars = UserLanguage::find($userLanguageId);

        return view('MyService.skill-edit', compact('myId', 'theSkill', 'userLanguageId', 'stars'));
    }

    public function update($userLanguageId, Request $request)
    {
        $stars = $request->input('star_count');

        $theSkill = UserLanguage::find($userLanguageId);
        $theSkill->star_count = $stars;
        $theSkill->save();

        $account = User::find($theSkill->user_id);

        $userId = $account->id;
        $skillId = $theSkill->language_id;

        return redirect()->route('skills.show', ['userId' => $userId, 'skillId' => $skillId]);
    }
}

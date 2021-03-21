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

class SkillStarController extends Controller
{

    public function add($userLanguageId)
    {
        $myId = Auth::id();

        // 欲しいやつ
        // 選択した言語
        // skill_itemにすでにある情報たち
        $theSkill = User_language::find($userLanguageId);

        

        //区別するためにstarsを用意
        $stars = User_language::find($userLanguageId);

        return view('MyService.skill_edit', compact('myId', 'theSkill', 'userLanguageId', 'stars'));
    }

    public function update($userLanguageId, Request $request)
    {
        $stars = $request->input('star_count');
        // 書き換えをしたい
        // user_languageテーブルのstar_countの

        $myId = Auth::id();

        $theSkill = User_language::find($userLanguageId);
        $theSkill->star_count = $stars;
        $theSkill->save();

        $account = User::find($theSkill->user_id);

        $userId = $account->id;
        $skillId = $theSkill->language_id;

        // 欲しいやつ
        // 選択した言語
        // skill_itemにすでにある情報たち
        $traces = Trace::where('user_language_id', $userLanguageId)->get();
        $skills = Skill::where('user_language_id', $userLanguageId)->get();


        // return redirect()->route('skill.show', ['userId' => $userId, 'skillId' =>$skillId ])->with([
        //     'theSkill' => $theSkill,
        //     'traces' => $traces,
        //     'skills' => $skills,
        //     'myId' => $myId,
        //     'account' => $account
        // ]);


        return redirect()->route('skill.show', ['userId' => $userId, 'skillId' =>$skillId ]);

        // return view('MyService.skill_item')->with([
        //     'theSkill' => $theSkill,
        //     'traces' => $traces,
        //     'skills' => $skills,
        //     'myId' => $myId,
        //     'account' => $account,
        //     'userId' => $userId,
        //     'skillId' => $skillId,
        //     'userLanguageId' => $userLanguageId
        // ]);
        
    }

}

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




class SkillController extends Controller
{
    //
    public function show($userId, $skillId)
    {

        $myId = Auth::id();

        // 取り出したい物
        // languageテーブルのname//
        // user_languageのstar_count//

        // skillのcontent
        // traceのimg,category,content

        // $skill = Skill::find($skillId);

        $theSkill = User_language::where('language_id', $skillId)->where('user_id', $userId)->first();

        $userLanguageId = $theSkill->id;

        // $theSkill = User_language::find($skillId);

        $account = User::find($userId);

        $traces = Trace::where('user_language_id', $userLanguageId)->get();
        $skills = Skill::where('user_language_id', $userLanguageId)->get();


        return view('MyService.skill_item', compact('theSkill', 'traces', 'skills', 'myId', 'account', 'skillId', 'userLanguageId'));
        
        
        // ->with([
        //     'theSkill' => $theSkill,
        //     'traces' => $traces,
        //     'skills' => $skills,
        //     'myId' => $myId,
        //     'account' => $account,
        //     'skillId' => $skillId,
        //     'userLanguageId' => $userLanguageId
        // ]);
    }

    public function add()
    {
        $myId = Auth::id();

        $user_languages = User_language::where('user_id', $myId)->get(['language_id']);

        $languages = Language::whereNotIn('id', $user_languages)->get();


        return view('MyService.skill_add', compact('myId', 'languages'));
    }

    public function store(Request $request)
    {
        // 保存する
        $myId = Auth::id();
        $account = User::find($myId);
        $the_skill = $request->language_id;

        // $myAccountの中間テーブルのuser_languagesテーブルにその番号を追加してsaveする
        // $account->languages()->attach($request->language_id, [
        //     'star_count' => 0
        // ]);
        // attach使った際に追加情報として配列

        // モデルversion

        // もしも作成したレコードで、user_idが同じかつlanguage_idも同じだったらそれは削除する



        $user_language = new User_language;
        $user_language->user_id = $myId;
        $user_language->language_id = $the_skill;
        $user_language->star_count = 1;
        $user_language->save();


        $languages = User_language::where('user_id', $myId)->get();


        return redirect()->route('home.my_home', ['userId' => $myId]);
        
        // ->with([
        //     'myId' => $myId,
        //     'account' => $account,
        //     'languages' => $languages
        // ]);;

        // return view('MyService.home')->with([
        //     'myId' => $myId,
        //     'account' => $account,
        //     'languages' => $languages
        // ]);
    }

    public function destroy($userLanguageId)
    {

        User_language::find($userLanguageId)->delete();

        $myId = Auth::id();
        $account = User::find($myId);
        $languages = User_language::where('user_id', $myId)->get();


        return redirect()->route('home.my_home', ['userId' => $myId]);
        
        // ->with([
        //     'myId' => $myId,
        //     'account' => $account,
        //     'languages' => $languages
        // ]);
    }


}

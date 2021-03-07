<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Language;
use App\User;
use App\User_language;
use App\Category;
use App\Trace;
use App\Skill;




class SkillController extends Controller
{
    //
    public function skill_item(Request $request)
    {
        $theSkillId = $request->input('id');

        $myId = Auth::id();

        // 取り出したい物
        // languageテーブルのname//
        // user_languageのstar_count//

        // skillのcontent
        // traceのimg,category,content

        $theSkill = User_language::find($theSkillId);

        $account = User::find($theSkill->user_id);

        $traces = Trace::where('user_language_id', $theSkillId)->get();
        $skills = Skill::where('user_language_id', $theSkillId)->get();


        return view('MyService.skill_item')->with([
            'theSkill' => $theSkill,
            'traces' => $traces,
            'skills' => $skills,
            'myId' => $myId,
            'account' => $account
        ]);
    }

    public function skill_add()
    {
        $myId = Auth::id();

        $user_languages = User_language::where('user_id', $myId)->get(['language_id']);

        $languages = Language::whereNotIn('id', $user_languages)->get();




        return view('MyService.skill_add')->with([
            'languages' => $languages
        ]);
    }

    public function skill_add_save(Request $request)
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


        return view('MyService.home')->with([
            'myId' => $myId,
            'account' => $account,
            'languages' => $languages
        ]);
    }

    public function skill_delete(Request $request)
    {
        $theSkillId = $request->input('id');
        User_language::find($theSkillId)->delete();

        $myId = Auth::id();
        $account = User::find($myId);
        $languages = User_language::where('user_id', $myId)->get();


        return redirect('/my_home')->with([
            'account' => $account,
            'myId' => $myId,
            'languages' => $languages,
        ]);
    }



    public function skill_edit_add_star(Request $request)
    {
        $theSkillId = $request->input('id');

        // 欲しいやつ
        // 選択した言語
        // skill_itemにすでにある情報たち
        $theSkill = User_language::find($theSkillId);

        $stars = User_language::find($theSkillId);

        return view('MyService.skill_edit')->with([
            'theSkill' => $theSkill,
            'stars' => $stars
        ]);
    }

    public function skill_edit_star(Request $request)
    {
        $theSkillId = $request->input('id');
        $stars = $request->input('star_count');
        // 書き換えをしたい
        // user_languageテーブルのstar_countの

        $myId = Auth::id();

        $theSkill = User_language::find($theSkillId);
        $theSkill->star_count = $stars;
        $theSkill->save();

        $account = User::find($theSkill->user_id);

        // 欲しいやつ
        // 選択した言語
        // skill_itemにすでにある情報たち
        $traces = Trace::where('user_language_id', $theSkillId)->get();
        $skills = Skill::where('user_language_id', $theSkillId)->get();


        return view('MyService.skill_item')->with([
            'theSkill' => $theSkill,
            'traces' => $traces,
            'skills' => $skills,
            'myId' => $myId,
            'account' => $account
        ]);
    }

    public function skill_edit_add_able(Request $request)
    {
        $theSkillId = $request->input('id');
        $theSkill = User_language::find($theSkillId);

        $skillables = Skill::where('user_language_id', $theSkillId)->get();

        return view('MyService.skill_edit')->with([
            'theSkill' => $theSkill,
            'skillables' => $skillables
        ]);
    }

    public function skill_edit_able(Request $request)
    {
        $theSkillId = $request->input('id');
        $ableText = $request->input('able');

        $myId = Auth::id();


        $skill = new Skill;
        $skill->user_language_id = $theSkillId;
        $skill->content = $ableText;
        $skill->save();

        $theSkill = User_language::find($theSkillId);
        $account = User::find($theSkill->user_id);

        $skillables = Skill::where('user_language_id', $theSkillId)->get();
        $traces = Trace::where('user_language_id', $theSkillId)->get();
        $skills = Skill::where('user_language_id', $theSkillId)->get();

        return view('MyService.skill_item')->with([
            'theSkill' => $theSkill,
            'traces' => $traces,
            'skills' => $skills,
            'myId' => $myId,
            'account' => $account
        ]);
    }

    public function skill_edit_add_trace(Request $request)
    {
        $theSkillId = $request->input('id');

        $theSkill = User_language::find($theSkillId);

        $skill_traces = Trace::all();
        $categories = Category::all();

        return view('MyService.skill_edit')->with([
            'theSkill' => $theSkill,
            'categories' => $categories,
            'skill_traces' => $skill_traces
        ]);
    }

    public function skill_edit_trace(Request $request)
    {
        // 奇跡の新規作成
        $trace_img = $request->file('trace_img');
        $theSkillId = $request->input('id');
        $traceText = $request->input('skill-trace');
        $category = $request->input('category');
        $file = $request->input('file');

        // traceテーブルのuser_language_idの数だけskill_1-2などと表示したい
        // $theSkillId_count =  Trace::where('user_language_id', $theSkillId)->count();

        // $file_name = 'skill_img_' . $theSkillId . '-' . ($theSkillId_count + 1) . '.jpeg';

        // $trace_img->storeAs('public/trace_images', $file_name);

        
        $trace = new Trace;
        if ($trace_img === null) {
            $trace->img = null;
        } else {
            $path = Storage::disk('s3')->putFile('trace_img', $trace_img, 'public');
            $trace->img = Storage::disk('s3')->url($path);
        }
        $trace->user_language_id = $theSkillId;
        $trace->category_id = $category;
        $trace->content = $traceText;
        $trace->save();

        $traces = Trace::where('user_language_id', $theSkillId)->get();


        $theSkill = User_language::find($theSkillId);
        $myId = Auth::id();
        $account = User::find($theSkill->user_id);

        $traces = Trace::where('user_language_id', $theSkillId)->get();
        $skills = Skill::where('user_language_id', $theSkillId)->get();


        return view('MyService.skill_item')->with([
            'theSkill' => $theSkill,
            'traces' => $traces,
            'skills' => $skills,
            'myId' => $myId,
            'account' => $account
        ]);
    }

    public function skillable_edit(Request $request)
    {
        // user_languageのid
        $theSkillId = $request->input('id');
        // skillのid
        $skill_id = $request->input('skill_id');


        $theSkill = User_language::find($theSkillId);

        $skillableEdits = Skill::find($skill_id);

        return view('MyService.skill_edit')->with([
            'theSkill' => $theSkill,
            'skillableEdits' => $skillableEdits
        ]);
    }

    public function skillable_edit_redirect(Request $request)
    {
        // user_languageのid
        $theSkillId = $request->input('id');
        // skillのid
        $skill_id = $request->input('skill_id');
        // skillのcontent
        $skill_content = $request->input('skill_content');

        $skillableEdits = Skill::find($skill_id);

        $skillableEdits->content = $skill_content;
        $skillableEdits->save();



        $theSkill = User_language::find($theSkillId);
        $myId = Auth::id();
        $account = User::find($theSkill->user_id);

        $traces = Trace::where('user_language_id', $theSkillId)->get();
        $skills = Skill::where('user_language_id', $theSkillId)->get();


        return view('MyService.skill_item')->with([
            'theSkill' => $theSkill,
            'traces' => $traces,
            'skills' => $skills,
            'myId' => $myId,
            'account' => $account
        ]);
    }

    public function skillable_delete(Request $request)
    {
        // user_languageのid
        $theSkillId = $request->input('id');
        // skillのid
        $skill_id = $request->input('skill_id');



        $theSkill = User_language::find($theSkillId);
        $myId = Auth::id();
        $account = User::find($theSkill->user_id);

        $skillableDelete = Skill::find($skill_id)->delete();

        $traces = Trace::where('user_language_id', $theSkillId)->get();
        $skills = Skill::where('user_language_id', $theSkillId)->get();


        return view('MyService.skill_item')->with([
            'theSkill' => $theSkill,
            'traces' => $traces,
            'skills' => $skills,
            'myId' => $myId,
            'account' => $account
        ]);
    }

    public function skill_trace_edit(Request $request)
    {
        $theSkillId = $request->input('id');
        $trace_id = $request->input('trace_id');


        $theSkill = User_language::find($theSkillId);

        $traceEdit = Trace::find($trace_id);

        $categories = Category::all();

        return view('MyService.skill_edit')->with([
            'theSkill' => $theSkill,
            'categories' => $categories,
            'traceEdit' => $traceEdit
        ]);
    }

    public function skill_trace_edit_redirect(Request $request)
    {
        // 軌跡の編集
        $trace_img = $request->file('trace_img');
        $theSkillId = $request->input('id');
        $trace_id = $request->input('trace_id');
        $trace_content = $request->input('trace_content');
        $category_id = $request->input('category_id');

                
        $traceEdits = Trace::find($trace_id);
        
        if ($trace_img === null) {
            $traceEdits->img = null;
        } else {
            $path = Storage::disk('s3')->putFile('trace_img', $trace_img, 'public');
            $traceEdits->img = Storage::disk('s3')->url($path);
        }

        $traceEdits->category_id = $category_id;
        $traceEdits->content = $trace_content;
        $traceEdits->save();

        $theSkill = User_language::find($theSkillId);
        $myId = Auth::id();
        $account = User::find($theSkill->user_id);

        $traces = Trace::where('user_language_id', $theSkillId)->get();
        $skills = Skill::where('user_language_id', $theSkillId)->get();

        // traceテーブルのuser_language_idの数だけskill_1-2などと表示したい
        // $theSkillId_count =  Trace::where('user_language_id', $theSkillId)->count();

        // $file_name = 'skill_img_' . $theSkillId . '-' . $theSkillId_count . '.jpeg';

        // $trace_img->storeAs('public/trace_images', $file_name);

        return view('MyService.skill_item')->with([
            'theSkill' => $theSkill,
            'traces' => $traces,
            'skills' => $skills,
            'myId' => $myId,
            'account' => $account
        ]);
    }

    public function skill_trace_delete(Request $request)
    {
        // user_languageのid
        $theSkillId = $request->input('id');
        // skillのid
        $trace_id = $request->input('trace_id');


        $theSkill = User_language::find($theSkillId);
        $myId = Auth::id();
        $account = User::find($theSkill->user_id);

        $traceDelete = Trace::find($trace_id)->delete();

        $traces = Trace::where('user_language_id', $theSkillId)->get();
        $skills = Skill::where('user_language_id', $theSkillId)->get();


        return view('MyService.skill_item')->with([
            'theSkill' => $theSkill,
            'traces' => $traces,
            'skills' => $skills,
            'myId' => $myId,
            'account' => $account
        ]);
    }
}

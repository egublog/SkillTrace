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

class SkillTraceController extends Controller
{
    //
    public function add($userLanguageId)
    {
        $myId = Auth::id();

        $theSkill = User_language::find($userLanguageId);

        $skill_traces = Trace::all();
        $categories = Category::all();

        return view('MyService.skill_edit', compact('myId', 'theSkill', 'userLanguageId', 'categories', 'skill_traces'));
    }

    public function store($userLanguageId, Request $request)
    {
        // 軌跡の新規作成
        $trace_img = $request->file('trace_img');
        // $theSkillId = $request->input('id');
        $traceText = $request->input('skill-trace');
        $category = $request->input('category');
        // $file = $request->input('file');

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
        $trace->user_language_id = $userLanguageId;
        $trace->category_id = $category;
        $trace->content = $traceText;
        $trace->save();

        // $traces = Trace::where('user_language_id', $userLanguageId)->get();


        $theSkill = User_language::find($userLanguageId);
        // $myId = Auth::id();
        $account = User::find($theSkill->user_id);
        $userId = $account->id;
        $skillId = $theSkill->language_id;

        // $traces = Trace::where('user_language_id', $userLanguageId)->get();
        // $skills = Skill::where('user_language_id', $userLanguageId)->get();


        return redirect()->route('skill.show', ['userId' => $userId, 'skillId' =>$skillId ]);
        
        // ->with([
        //     'theSkill' => $theSkill,
        //     'traces' => $traces,
        //     'skills' => $skills,
        //     'myId' => $myId,
        //     'account' => $account,
        //     'skillId' => $skillId
        // ]);;

        // return view('MyService.skill_item')->with([
        //     'theSkill' => $theSkill,
        //     'traces' => $traces,
        //     'skills' => $skills,
        //     'myId' => $myId,
        //     'account' => $account,
        //     'skillId' => $skillId
        // ]);
    }






    public function show($userLanguageId, $traceId)
    {
        $myId = Auth::id();

        $theSkill = User_language::find($userLanguageId);

        $traceEdit = Trace::find($traceId);

        $categories = Category::all();

        return view('MyService.skill_edit', compact('myId', 'theSkill', 'categories', 'traceEdit', 'traceId', 'userLanguageId'));
        
        // ->with([
        //     'myId' => $myId,
        //     'theSkill' => $theSkill,
        //     'categories' => $categories,
        //     'traceEdit' => $traceEdit,
        //     'traceId' => $traceId,
        //     'userLanguageId' => $userLanguageId
        // ]);
    }

    public function update($userLanguageId, $traceId, Request $request)
    {
        // 軌跡の編集
        $trace_img = $request->file('trace_img');
        // $theSkillId = $request->input('id');
        // $trace_id = $request->input('trace_id');
        $trace_content = $request->input('trace_content');
        $category_id = $request->input('category_id');

                
        $traceEdits = Trace::find($traceId);
        
        if ($trace_img === null) {
            $traceEdits->img = null;
        } else {
            $path = Storage::disk('s3')->putFile('trace_img', $trace_img, 'public');
            $traceEdits->img = Storage::disk('s3')->url($path);
        }

        $traceEdits->category_id = $category_id;
        $traceEdits->content = $trace_content;
        $traceEdits->save();

        $theSkill = User_language::find($userLanguageId);
        // $myId = Auth::id();
        $account = User::find($theSkill->user_id);
        $userId = $account->id;
        $skillId = $theSkill->language_id;

        // $traces = Trace::where('user_language_id', $userLanguageId)->get();
        // $skills = Skill::where('user_language_id', $userLanguageId)->get();

        // traceテーブルのuser_language_idの数だけskill_1-2などと表示したい
        // $theSkillId_count =  Trace::where('user_language_id', $theSkillId)->count();

        // $file_name = 'skill_img_' . $theSkillId . '-' . $theSkillId_count . '.jpeg';

        // $trace_img->storeAs('public/trace_images', $file_name);

        return redirect()->route('skill.show', ['userId' => $userId, 'skillId' => $skillId ]);
        
        // ->with([
        //     'theSkill' => $theSkill,
        //     'traces' => $traces,
        //     'skills' => $skills,
        //     'myId' => $myId,
        //     'account' => $account,
        //     'skillId' => $skillId
        // ]);;

        // return view('MyService.skill_item')->with([
        //     'theSkill' => $theSkill,
        //     'traces' => $traces,
        //     'skills' => $skills,
        //     'myId' => $myId,
        //     'account' => $account,
        //     'skillId' => $skillId
        // ]);
    }

    public function destroy($userLanguageId, $traceId)
    {
        // user_languageのid
        // $theSkillId = $request->input('id');
        // skillのid
        // $trace_id = $request->input('trace_id');


        $theSkill = User_language::find($userLanguageId);
        // $myId = Auth::id();
        $account = User::find($theSkill->user_id);
        $userId = $account->id;
        $skillId = $theSkill->language_id;

        Trace::find($traceId)->delete();

        // $traces = Trace::where('user_language_id', $userLanguageId)->get();
        // $skills = Skill::where('user_language_id', $userLanguageId)->get();


        return redirect()->route('skill.show', ['userId' => $userId, 'skillId' => $skillId ]);
        
        // ->with([
        //     'theSkill' => $theSkill,
        //     'traces' => $traces,
        //     'skills' => $skills,
        //     'myId' => $myId,
        //     'account' => $account,
        //     'skillId' => $skillId
        // ]);;

        // return view('MyService.skill_item')->with([
        //     'theSkill' => $theSkill,
        //     'traces' => $traces,
        //     'skills' => $skills,
        //     'myId' => $myId,
        //     'account' => $account,
        //     'skillId' => $skillId
        // ]);
    }


}

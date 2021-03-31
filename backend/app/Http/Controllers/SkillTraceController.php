<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\User_language;
use App\Models\Category;
use App\Models\Trace;
use App\Http\Requests\SkillTraceImageRequest;

class SkillTraceController extends Controller
{
    public function create($userLanguageId)
    {
        $myId = Auth::id();

        $theSkill = User_language::find($userLanguageId);

        $skill_traces = Trace::all();
        $categories = Category::all();

        return view('MyService.skill-edit', compact('myId', 'theSkill', 'userLanguageId', 'categories', 'skill_traces'));
    }

    public function store($userLanguageId, SkillTraceImageRequest $request)
    {
        $trace_img = $request->file('trace_img');
        $traceText = $request->input('skill-trace');
        $category = $request->input('category');

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

        $theSkill = User_language::find($userLanguageId);
        $account = User::find($theSkill->user_id);
        $userId = $account->id;
        $skillId = $theSkill->language_id;

        return redirect()->route('skills.show', ['userId' => $userId, 'skillId' =>$skillId ]);
    }

    public function show($userLanguageId, $traceId)
    {
        $myId = Auth::id();

        $theSkill = User_language::find($userLanguageId);

        $traceEdit = Trace::find($traceId);

        $categories = Category::all();

        return view('MyService.skill-edit', compact('myId', 'theSkill', 'categories', 'traceEdit', 'traceId', 'userLanguageId'));
    }

    public function update($userLanguageId, $traceId, SkillTraceImageRequest $request)
    {
        $trace_img = $request->file('trace_img');
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

        $account = User::find($theSkill->user_id);
        $userId = $account->id;
        $skillId = $theSkill->language_id;

        return redirect()->route('skills.show', ['userId' => $userId, 'skillId' => $skillId ]);
    }

    public function destroy($userLanguageId, $traceId)
    {

        $theSkill = User_language::find($userLanguageId);

        $account = User::find($theSkill->user_id);
        $userId = $account->id;
        $skillId = $theSkill->language_id;

        Trace::find($traceId)->delete();

        return redirect()->route('skills.show', ['userId' => $userId, 'skillId' => $skillId ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\UserLanguage;
use App\Models\Category;
use App\Models\Trace;
use App\Http\Requests\SkillTraceRequest;

class SkillTraceController extends Controller
{
    public function create($userLanguageId)
    {
        $myId = Auth::id();

        $theSkill = UserLanguage::find($userLanguageId);

        $traces = Trace::all();
        $categories = Category::all();

        return view('MyService.skill-edit', compact('myId', 'theSkill', 'userLanguageId', 'categories', 'traces'));
    }

    public function store($userLanguageId, SkillTraceRequest $request)
    {
        $traceImg = $request->file('trace_img');
        $traceText = $request->input('trace');
        $traceCategory = $request->input('category');

        $trace = new Trace;
        if ($traceImg === null) {
            $trace->img = null;
        } else {
            $path = Storage::disk('s3')->putFile('trace_img', $traceImg, 'public');
            $trace->img = Storage::disk('s3')->url($path);
        }

        $trace->user_language_id = $userLanguageId;
        $trace->category_id = $traceCategory;
        $trace->content = $traceText;
        $trace->save();

        $theSkill = UserLanguage::find($userLanguageId);

        $userId = $theSkill->user_id;
        $skillId = $theSkill->language_id;

        return redirect()->route('skills.show', ['userId' => $userId, 'skillId' => $skillId]);
    }

    public function show($userLanguageId, $traceId)
    {
        $myId = Auth::id();

        $theSkill = UserLanguage::find($userLanguageId);

        $traceEdit = Trace::find($traceId);

        $categories = Category::all();

        return view('MyService.skill-edit', compact('myId', 'theSkill', 'categories', 'traceEdit', 'traceId', 'userLanguageId'));
    }

    public function update($userLanguageId, $traceId, SkillTraceRequest $request)
    {
        $traceImg = $request->file('trace_img');
        $traceContent = $request->input('trace');
        $traceCategoryId = $request->input('category');

        $traceEdit = Trace::find($traceId);

        if ($traceImg === null) {
            $traceEdit->img = null;
        } else {
            $path = Storage::disk('s3')->putFile('trace_img', $traceImg, 'public');
            $traceEdit->img = Storage::disk('s3')->url($path);
        }

        $traceEdit->category_id = $traceCategoryId;
        $traceEdit->content = $traceContent;
        $traceEdit->save();

        $theSkill = UserLanguage::find($userLanguageId);

        $userId = $theSkill->user_id;
        $skillId = $theSkill->language_id;

        return redirect()->route('skills.show', ['userId' => $userId, 'skillId' => $skillId]);
    }

    public function destroy($userLanguageId, $traceId)
    {

        $theSkill = UserLanguage::find($userLanguageId);

        $userId = $theSkill->user_id;
        $skillId = $theSkill->language_id;

        Trace::find($traceId)->delete();

        return redirect()->route('skills.show', ['userId' => $userId, 'skillId' => $skillId]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\UserLanguage;
use App\Models\Category;
use App\Models\Trace;
use App\Http\Requests\SkillTraceRequest;
use App\Services\UserAuthServiceInterface;

class SkillTraceController extends Controller
{
    protected $userAuthService;

    public function __construct(
        UserAuthServiceInterface $userAuthService
    )
    {
        $this->userAuthService = $userAuthService;
    }

    public function create(int $userLanguageId)
    {
        $myId     = $this->userAuthService->getLoginUserId();

        $theSkill = UserLanguage::find($userLanguageId);

        $traces = Trace::all();
        $categories = Category::all();

        return view('MyService.skill-edit', compact('myId', 'theSkill', 'userLanguageId', 'categories', 'traces'));
    }

    public function store(int $userLanguageId, SkillTraceRequest $request)
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

    public function show(int $userLanguageId, int $traceId)
    {
        $myId     = $this->userAuthService->getLoginUserId();

        $theSkill = UserLanguage::find($userLanguageId);

        $traceEdit = Trace::find($traceId);

        $categories = Category::all();

        return view('MyService.skill-edit', compact('myId', 'theSkill', 'categories', 'traceEdit', 'traceId', 'userLanguageId'));
    }

    public function update(int $userLanguageId, int $traceId, SkillTraceRequest $request)
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

    public function destroy(int $userLanguageId, int $traceId)
    {

        $theSkill = UserLanguage::find($userLanguageId);

        $userId = $theSkill->user_id;
        $skillId = $theSkill->language_id;

        Trace::find($traceId)->delete();

        return redirect()->route('skills.show', ['userId' => $userId, 'skillId' => $skillId]);
    }
}

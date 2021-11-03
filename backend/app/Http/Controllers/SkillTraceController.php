<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Trace;
use App\Http\Requests\SkillTraceRequest;
use App\Repositories\TraceRepositoryInterface;
use App\Repositories\UserLanguageRepositoryInterface;
use App\Services\UserAuthServiceInterface;

class SkillTraceController extends Controller
{
    protected $userAuthService;
    protected $userLanguageRepository;
    protected $traceRepository;
    protected $categoryRepository;

    public function __construct(
        UserAuthServiceInterface $userAuthService,
        UserLanguageRepositoryInterface $userLanguageRepository,
        TraceRepositoryInterface $traceRepository,
        CategoryRepositoryInterface $categoryRepository
    )
    {
        $this->userAuthService        = $userAuthService;
        $this->userLanguageRepository = $userLanguageRepository;
        $this->traceRepository        = $traceRepository;
        $this->categoryRepository     = $categoryRepository;
    }

    public function create(int $userLanguageId)
    {
        $myId     = $this->userAuthService->getLoginUserId();

        $theSkill = $this->userLanguageRepository->findById($userLanguageId);

        $traces = $this->traceRepository->getAll();
        $categories = $this->categoryRepository->getAll();

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

        $theSkill = $this->userLanguageRepository->findById($userLanguageId);

        $userId = $theSkill->user_id;
        $skillId = $theSkill->language_id;

        return redirect()->route('skills.show', ['userId' => $userId, 'skillId' => $skillId]);
    }

    public function show(int $userLanguageId, int $traceId)
    {
        $myId     = $this->userAuthService->getLoginUserId();

        $theSkill = $this->userLanguageRepository->findById($userLanguageId);

        $traceEdit = $this->traceRepository->findById($traceId);

        $categories = $this->categoryRepository->getAll();

        return view('MyService.skill-edit', compact('myId', 'theSkill', 'categories', 'traceEdit', 'traceId', 'userLanguageId'));
    }

    public function update(int $userLanguageId, int $traceId, SkillTraceRequest $request)
    {
        $traceImg = $request->file('trace_img');
        $traceContent = $request->input('trace');
        $traceCategoryId = $request->input('category');

        $traceEdit = $this->categoryRepository->findById($traceId);

        if ($traceImg === null) {
            $traceEdit->img = null;
        } else {
            $path = Storage::disk('s3')->putFile('trace_img', $traceImg, 'public');
            $traceEdit->img = Storage::disk('s3')->url($path);
        }

        $traceEdit->category_id = $traceCategoryId;
        $traceEdit->content = $traceContent;
        $traceEdit->save();

        $theSkill = $this->userLanguageRepository->findById($userLanguageId);

        $userId = $theSkill->user_id;
        $skillId = $theSkill->language_id;

        return redirect()->route('skills.show', ['userId' => $userId, 'skillId' => $skillId]);
    }

    public function destroy(int $userLanguageId, int $traceId)
    {

        $theSkill = $this->userLanguageRepository->findById($userLanguageId);

        $userId = $theSkill->user_id;
        $skillId = $theSkill->language_id;

        $this->traceRepository->deleteById($traceId);

        return redirect()->route('skills.show', ['userId' => $userId, 'skillId' => $skillId]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\ProfileImageRequest;
use App\Models\User;
use App\Models\Area;
use App\Models\History;
use App\Models\Language;
use App\Services\UserAuthServiceInterface;

class ProfileController extends Controller
{
    protected $userAuthService;

    public function __construct(
        UserAuthServiceInterface $userAuthService
    )
    {
        $this->userAuthService = $userAuthService;
    }

    public function index()
    {
        $myId      = $this->userAuthService->getLoginUserId();
        $myAccount = User::find($myId);
        $area      = Area::all();
        $histories = History::all();
        $languages = Language::all();

        return view('MyService.profile', compact('myId', 'areas', 'histories', 'languages', 'myAccount'));
    }

    public function store(ProfileRequest $request)
    {
        $myId    = $this->userAuthService->getLoginUserId();
        $account = User::find($myId);

        $account->update($request->userAttributes());

        return redirect()->route('home.home', ['userId' => $myId]);
    }

    public function img_store(ProfileImageRequest $request) {

        $userImg   = $request->file('profile_img');

        $myId      = $this->userAuthService->getLoginUserId();
        $myAccount = User::find($myId);

        $path           = Storage::disk('s3')->putFile('profile_img', $userImg, 'public');
        $myAccount->img = Storage::disk('s3')->url($path);

        $myAccount->save();

        return redirect()->route('profiles.index');
    }
}

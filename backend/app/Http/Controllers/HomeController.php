<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserLanguage;
use App\Models\Follow;
use App\Services\UserAuthServiceInterface;

class HomeController extends Controller
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
        $myId    = $this->userAuthService->getLoginUserId();
        $account = User::find($myId);

        return view('home', compact('myId', 'account'));
    }


    public function home(int $userId)
    {
        $myId      = $this->userAuthService->getLoginUserId();
        $myAccount = User::find($myId);

        $languages = UserLanguage::getLanguageAsc($userId)->get();

        $account = User::findOrFail($userId);

        $followCheck = Follow::mutualFollow($myId, $userId)->first();

        Follow::followCheck($followCheck);

        return view('MyService.home', compact('myId', 'myAccount', 'userId', 'account', 'languages', 'followCheck'));
    }
}

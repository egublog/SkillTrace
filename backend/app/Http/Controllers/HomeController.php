<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserLanguage;
use App\Models\Follow;
use App\Repositories\FollowRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Services\UserAuthServiceInterface;

class HomeController extends Controller
{
    protected $userAuthService;
    protected $userRepository;
    protected $followRepository;

    public function __construct(
        UserAuthServiceInterface $userAuthService,
        UserRepositoryInterface $userRepository,
        FollowRepositoryInterface $followRepository
    )
    {
        $this->userAuthService  = $userAuthService;
        $this->userRepository   = $userRepository;
        $this->followRepository = $followRepository;
    }

    public function index()
    {
        $myId    = $this->userAuthService->getLoginUserId();
        $account = $this->userRepository->findById($myId);

        return view('home', compact('myId', 'account'));
    }


    public function home(int $userId)
    {
        $myId      = $this->userAuthService->getLoginUserId();
        $myAccount = $this->userRepository->findById($myId);

        $languages = UserLanguage::getLanguageAsc($userId)->get();

        // TODO: 独自のHomeHomeRequestを作成し、userIdがない場合を考慮する。
        $account = $this->userRepository->findById($userId);

        $followCheck = $this->followRepository->getByUserIdAndUserToId($myId, $userId);

        $this->followRepository->followCheck($followCheck);

        return view('MyService.home', compact('myId', 'myAccount', 'userId', 'account', 'languages', 'followCheck'));
    }
}

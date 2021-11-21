<?php

namespace App\Http\Controllers;

use App\Repositories\FollowRepositoryInterface;
use App\Repositories\UserLanguageRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Services\UserAuthServiceInterface;

/**
 * ホームページを表示するコントローラー
 */
class HomeController extends Controller
{
    protected $userAuthService;
    protected $userRepository;
    protected $followRepository;
    protected $userLanguageRepository;

    public function __construct(
        UserAuthServiceInterface $userAuthService,
        UserRepositoryInterface $userRepository,
        FollowRepositoryInterface $followRepository,
        UserLanguageRepositoryInterface $userLanguageRepository
    )
    {
        $this->userAuthService        = $userAuthService;
        $this->userRepository         = $userRepository;
        $this->followRepository       = $followRepository;
        $this->userLanguageRepository = $userLanguageRepository;
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

        $languages = $this->userLanguageRepository->findByUserIdAndAscByLanguageId($userId);
        $languages->load('language');

        // TODO: 独自のHomeHomeRequestを作成し、userIdがない場合を考慮する。
        $account = $this->userRepository->findById($userId);

        $followCheck = $this->followRepository->getByUserIdAndUserToId($myId, $userId);

        $this->followRepository->followCheck($followCheck);

        return view('MyService.home', compact('myId', 'myAccount', 'userId', 'account', 'languages', 'followCheck'));
    }
}

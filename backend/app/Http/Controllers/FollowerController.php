<?php

namespace App\Http\Controllers;

use App\Repositories\FollowRepositoryInterface;
use App\Services\UserAuthServiceInterface;
use App\UseCase\FollowerIndexCaseInterface;

/**
 * フォロワーに関するコントローラー
 */
class FollowerController extends Controller
{
    protected $followerIndexCase;

    public function __construct(
        FollowerIndexCaseInterface $followerIndexCase
    ) {
        $this->followerIndexCase = $followerIndexCase;
    }

    // NOTE: UseCase層を作ったが、引数の$userIdをどう処理するか迷うため、一旦放置
    public function index(int $userId)
    {
        $followers = $this->followerIndexCase->handle($userId);

        return $followers;
    }
}

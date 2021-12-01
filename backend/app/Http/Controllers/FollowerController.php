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

    public function index(int $userId)
    {
        $followers = $this->followerIndexCase->handle($userId);

        return $followers;
    }
}

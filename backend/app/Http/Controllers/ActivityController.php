<?php

namespace App\Http\Controllers;

use App\Repositories\FollowRepositoryInterface;
use App\Services\UserAuthServiceInterface;
use App\UseCase\ActivityIndexCaseInterface;

class ActivityController extends Controller
{
    protected $activityIndexCase;

    public function __construct(
        ActivityIndexCaseInterface $activityIndexCase
    )
    {
        $this->activityIndexCase = $activityIndexCase;
    }

    public function __invoke()
    {
        $activities = $this->activityIndexCase->handle();

        return $activities;
    }
}

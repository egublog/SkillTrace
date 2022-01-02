<?php

namespace App\Http\Controllers;

use App\UseCase\ActivityIndexCaseInterface;

/**
 * フォローされた可動化の通知に関するコントローラー
 */
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

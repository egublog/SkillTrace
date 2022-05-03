<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\UseCase\ActivityIndexCaseInterface;
use Illuminate\Contracts\View\View;

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

    public function __invoke(): View
    {
        $activities = $this->activityIndexCase->handle();

        return $activities;
    }
}

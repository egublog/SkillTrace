<?php
namespace App\UseCase;

use Illuminate\Contracts\View\View;
use stdClass;

interface FollowingIndexCaseInterface
{
    public function handle(int $userId): View;
}

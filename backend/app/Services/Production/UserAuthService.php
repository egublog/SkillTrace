<?php

namespace App\Services\Production;

use App\Services\UserAuthServiceInterface;
use Illuminate\Support\Facades\Auth;

class UserAuthService extends UserAuthServiceInterface
{
    public function getLoginUserId(): int
    {
        return Auth::id();
    }
}

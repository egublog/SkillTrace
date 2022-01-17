<?php

namespace App\Services\Production;

use App\Services\UserAuthServiceInterface;
use Illuminate\Support\Facades\Auth;

/**
 * userの認証を行うサービスクラス
 */
class UserAuthService implements UserAuthServiceInterface
{
    public function getLoginUserId(): int
    {
        return Auth::id();
    }
}

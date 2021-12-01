<?php
namespace App\UseCase;

use Illuminate\Contracts\View\View;

interface HomeHomeCaseInterface
{
    public function handle(int $userId): View;
}

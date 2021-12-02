<?php
namespace App\UseCase;

use Illuminate\Contracts\View\View;

interface ProfileIndexCaseInterface
{
    public function handle(): View;
}

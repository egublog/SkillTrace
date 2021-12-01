<?php
namespace App\UseCase;

use Illuminate\Contracts\View\View;

interface HomeIndexCaseInterface
{
    public function handle(): View;
}

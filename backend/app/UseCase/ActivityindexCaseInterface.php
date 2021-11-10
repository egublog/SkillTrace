<?php
namespace App\UseCase;

use Illuminate\Contracts\View\View;

interface ActivityIndexCaseInterface
{
    public function handle(): View;
}

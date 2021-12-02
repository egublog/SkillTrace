<?php
namespace App\UseCase;

use Illuminate\Contracts\View\View;

interface SearchIndexCaseInterface
{
    public function handle(): View;
}

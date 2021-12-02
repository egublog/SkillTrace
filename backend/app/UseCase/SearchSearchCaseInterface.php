<?php
namespace App\UseCase;

use Illuminate\Contracts\View\View;

interface SearchSearchCaseInterface
{
    public function handle(array $validated): View;
}

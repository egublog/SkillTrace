<?php
namespace App\UseCase;

use Illuminate\Http\RedirectResponse;

interface ProfileStoreCaseInterface
{
    public function handle(array $validated): RedirectResponse;
}

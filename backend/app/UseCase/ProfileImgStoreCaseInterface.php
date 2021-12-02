<?php
namespace App\UseCase;

use Illuminate\Http\RedirectResponse;

interface ProfileImgStoreCaseInterface
{
    public function handle(array $validated): RedirectResponse;
}

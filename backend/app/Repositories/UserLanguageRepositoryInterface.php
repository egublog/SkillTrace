<?php

namespace App\Repositories;

use App\Models\UserLanguage;

interface UserLanguageRepositoryInterface
{
    public function findById(int $id): ?UserLanguage;

    public function create(array $savingAssoc);

    public function update(array $savingAssoc): ?bool;

    public function delete(array $deleteAssoc): ?bool;
}

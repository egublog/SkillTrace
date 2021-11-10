<?php

namespace App\Repositories;

use App\Models\UserLanguage;
use Illuminate\Database\Eloquent\Collection;

interface UserLanguageRepositoryInterface
{
    public function findById(int $id): ?UserLanguage;

    public function create(array $savingAssoc): UserLanguage;

    public function update(array $savingAssoc): ?bool;

    public function delete(array $deleteAssoc): ?bool;

    public function findByUserIdAndLanguageId(int $userId, int $languageId): ?UserLanguage;

    public function findByUserIdAndAscByLanguageId(int $userId): Collection;

    public function findByUserIdAndGetLanguageId(int $userId): Collection;
}

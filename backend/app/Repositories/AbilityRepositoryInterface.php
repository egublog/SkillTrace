<?php

namespace App\Repositories;

use App\Models\Ability;
use Illuminate\Database\Eloquent\Collection;

interface AbilityRepositoryInterface
{
    public function findById(int $id): ?Ability;

    public function getByUserLanguageId(int $userLanguageId): Collection;

    public function create(array $savingAssoc): Ability;

    public function update(array $savingAssoc): ?bool;

    public function delete(array $deleteAssoc): ?bool;
}

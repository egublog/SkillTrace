<?php

namespace App\Repositories;

use App\Models\Ability;

interface AbilityRepositoryInterface
{
    public function findById(int $id): ?Ability;

    public function create(array $savingAssoc);

    public function update(array $savingAssoc): ?bool;

    public function delete(array $deleteAssoc): ?bool;
}

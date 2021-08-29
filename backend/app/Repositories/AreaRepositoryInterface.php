<?php

namespace App\Repositories;

use App\Models\Area;

interface AreaRepositoryInterface
{
    public function findById(int $id): ?Area;

    public function create(array $savingAssoc);

    public function update(array $savingAssoc): ?bool;

    public function delete(array $deleteAssoc): ?bool;
}

<?php

namespace App\Repositories;

use App\Models\Area;
use Illuminate\Database\Eloquent\Collection;

interface AreaRepositoryInterface
{
    public function findById(int $id): ?Area;

    public function getAll(): Collection;

    public function create(array $savingAssoc);

    public function update(array $savingAssoc): ?bool;

    public function delete(array $deleteAssoc): ?bool;
}

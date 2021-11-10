<?php

namespace App\Repositories;

use App\Models\History;
use Illuminate\Database\Eloquent\Collection;

interface HistoryRepositoryInterface
{
    public function findById(int $id): ?History;

    public function getAll(): Collection;

    public function create(array $savingAssoc): History;

    public function update(array $savingAssoc): ?bool;

    public function delete(array $deleteAssoc): ?bool;
}

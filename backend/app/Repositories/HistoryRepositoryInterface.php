<?php

namespace App\Repositories;

use App\Models\History;

interface HistoryRepositoryInterface
{
    public function findById(int $id): ?History;

    public function create(array $savingAssoc);

    public function update(array $savingAssoc): ?bool;

    public function delete(array $deleteAssoc): ?bool;
}

<?php

namespace App\Repositories;

use App\Models\Trace;
use Illuminate\Database\Eloquent\Collection;

interface TraceRepositoryInterface
{
    public function findById(int $id): ?Trace;

    public function getAll(): Collection;

    public function getByUserLanguageId(int $userLanguageId): Collection;

    public function create(array $savingAssoc): Trace;

    public function update(array $savingAssoc): ?bool;

    public function delete(array $deleteAssoc): ?bool;

    public function deleteById(int $id): ?bool;
}

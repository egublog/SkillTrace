<?php

namespace App\Repositories;

use App\Models\Trace;
use Illuminate\Database\Eloquent\Collection;

interface TraceRepositoryInterface
{
    public function findById(int $id): ?Trace;

    public function getByUserLanguageId(int $userLanguageId): Collection;

    public function create(array $savingAssoc);

    public function update(array $savingAssoc): ?bool;

    public function delete(array $deleteAssoc): ?bool;
}

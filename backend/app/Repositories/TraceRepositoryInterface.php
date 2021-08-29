<?php

namespace App\Repositories;

use App\Models\Trace;

interface TraceRepositoryInterface
{
    public function findById(int $id): ?Trace;

    public function create(array $savingAssoc);

    public function update(array $savingAssoc): ?bool;

    public function delete(array $deleteAssoc): ?bool;
}

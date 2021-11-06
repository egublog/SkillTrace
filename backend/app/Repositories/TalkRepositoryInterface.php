<?php

namespace App\Repositories;

use App\Models\Talk;

interface TalkRepositoryInterface
{
    public function findById(int $id): ?Talk;

    public function create(array $savingAssoc);

    public function update(array $savingAssoc): ?bool;

    public function delete(array $deleteAssoc): ?bool;
}

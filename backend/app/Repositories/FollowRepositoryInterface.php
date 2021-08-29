<?php

namespace App\Repositories;

use App\Models\Follow;

interface FollowRepositoryInterface
{
    public function findById(int $id): ?Follow;

    public function create(array $savingAssoc);

    public function update(array $savingAssoc): ?bool;

    public function delete(array $deleteAssoc): ?bool;
}

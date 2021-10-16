<?php

namespace App\Repositories;

use App\Models\Follow;
use Illuminate\Database\Eloquent\Collection;

interface FollowRepositoryInterface
{
    public function findById(int $id): ?Follow;

    public function create(array $savingAssoc);

    public function update(array $savingAssoc): ?bool;

    public function delete(array $deleteAssoc): ?bool;

    public function getByUserId(int $userId): Collection;

    public function getByUserToId(int $userToId): Collection;

    public function getByUserIdAndUserToId(int $userId, int $userToId): ?Follow;

    public function followCheck(?Follow $followCheck): void;
}

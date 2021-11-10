<?php

namespace App\Repositories;

use App\Models\Talk;
use Illuminate\Database\Eloquent\Collection;

interface TalkRepositoryInterface
{
    public function findById(int $id): ?Talk;

    public function getByUserId(int $userId): Collection;

    public function getByUserToId(int $userToId): Collection;

    public function getLatestByUserIdOrUserToId(int $userId): Collection;

    public function getTalkByTheFriendId(int $userId, int $theFriendId): Collection;

    public function create(array $savingAssoc): Talk;

    public function update(array $savingAssoc): ?bool;

    public function delete(array $deleteAssoc): ?bool;
}

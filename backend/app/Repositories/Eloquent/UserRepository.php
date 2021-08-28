<?php

namespace App\Repositories\Eloquent;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    protected $user;

    /**
     * @param object $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function findById(int $id): ?User
    {
        return $this->user->where('id', $id)->first();
    }

    public function create(array $savingAssoc): User
    {
        return $this->user->create($savingAssoc);
    }

    public function update(array $savingAssoc): ?bool
    {
        return $this->user->update($savingAssoc);
    }

    public function delete(array $deleteAssoc): ?bool
    {
        return $this->user->delete($deleteAssoc);
    }
}

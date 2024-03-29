<?php

namespace App\Repositories;

use App\Models\Language;
use Illuminate\Database\Eloquent\Collection;

interface LanguageRepositoryInterface
{
    public function findById(int $id): ?Language;

    public function getAll(): Collection;

    public function getWhereNotInId(int $id): Collection;

    public function create(array $savingAssoc): Language;

    public function update(array $savingAssoc): ?bool;

    public function delete(array $deleteAssoc): ?bool;
}

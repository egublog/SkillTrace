<?php

namespace App\Repositories;

use App\Models\Language;

interface LanguageRepositoryInterface
{
    public function findById(int $id): ?Language;

    public function create(array $savingAssoc);

    public function update(array $savingAssoc): ?bool;

    public function delete(array $deleteAssoc): ?bool;
}

<?php

namespace App\Repositories\Eloquent;

use App\Models\Language;
use App\Repositories\LanguageRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

final class LanguageRepository implements LanguageRepositoryInterface
{

    private $model;

    /**
     * @param object $model
     */
    public function __construct(LanguageRepositoryInterface $model)
    {
        $this->model = $model;
    }

    /**
     * idで検索するためのメソッド。
     *
     * @param integer $id
     * @return Language|null
     */
    public function findById(int $id): ?Language
    {
        return $this->model
            ->where('id', $id)
            ->first();
    }

    /**
     * 全てのLanguageを取得するためのメソッド。
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll(): Collection
    {
        return $this->model->all();
    }

    /**
     * 保存するためのメソッド。
     *
     * @param array $savingAssoc 保存する対象の連想配列
     *                           [
     *                           ]
     *
     * @return Language 保存した内容を返す
     */
    public function create(array $savingAssoc)
    {
        return $this->model
            ->create(
                $savingAssoc
            );
    }

    /**
     * 更新するためのメソッド。
     *
     * @param array $savingAssoc 更新する対象の連想配列
     *                           [
     *                           ]
     *
     * @return null|bool 更新が成功したらtrue, 失敗したらfalseを返す
     */
    public function update(array $savingAssoc): ?bool
    {
        return $this->model
            ->update(
                $savingAssoc
            );
    }

    /**
     * 削除するためのメソッド。
     *
     * @param array $deleteAssoc 削除する対象の連想配列
     *                           [
     *                           ]
     *
     * @return null|bool 削除が成功したらtrue, 失敗したらfalseを返す
     */
    public function delete(array $deleteAssoc): ?bool
    {
        return $this->model
            ->delete(
                $deleteAssoc
            );
    }
}

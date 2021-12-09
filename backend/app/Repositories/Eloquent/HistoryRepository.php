<?php

namespace App\Repositories\Eloquent;

use App\Models\History;
use App\Repositories\HistoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Historyモデルを操作するリポジトリクラス
 */
final class HistoryRepository implements HistoryRepositoryInterface
{

    private $model;

    /**
     * @param object $model
     */
    public function __construct(HistoryRepositoryInterface $model)
    {
        $this->model = $model;
    }

    /**
     * idで検索するためのメソッド。
     *
     * @param integer $id
     * @return History|null
     */
    public function findById(int $id): ?History
    {
        return $this->model
            ->where('id', $id)
            ->first();
    }

    /**
     * 全てのHistoryを取得するためのメソッド。
     *
     * @return Collection
     */

    public function getAll(): Collection
    {
        return $this->model
            ->all();
    }

    /**
     * 保存するためのメソッド。
     *
     * @param array $savingAssoc 保存する対象の連想配列
     *                           [
     *                           ]
     *
     * @return History 保存した内容を返す
     */
    public function create(array $savingAssoc): History
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

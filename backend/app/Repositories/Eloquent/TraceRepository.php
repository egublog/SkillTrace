<?php

namespace App\Repositories\Eloquent;

use App\Models\Trace;
use App\Repositories\TraceRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Traceモデルを操作するリポジトリクラス
 */
final class TraceRepository implements TraceRepositoryInterface
{

    private $model;

    /**
     * @param object $model
     */
    public function __construct(TraceRepositoryInterface $model)
    {
        $this->model = $model;
    }

    /**
     * idで検索するためのメソッド。
     *
     * @param integer $id
     * @return Trace|null
     */
    public function findById(int $id): ?Trace
    {
        return $this->model
            ->where('id', $id)
            ->first();
    }

    /**
     * 全件取得するためのメソッド。
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->model->all();
    }

    /**
     * user_language_idを指定して検索するためのメソッド。
     *
     * @param integer $userLanguageId
     * @return Collection
     */
    public function getByUserLanguageId(int $userLanguageId): Collection
    {
        return $this->model
            ->where('user_language_id', $userLanguageId)
            ->get();
    }

    /**
     * 保存するためのメソッド。
     *
     * @param array $savingAssoc 保存する対象の連想配列
     *                           [
     *                           ]
     *
     * @return Trace 保存した内容を返す
     */
    public function create(array $savingAssoc): Trace
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

    /**
     * idを指定して削除するためのメソッド。
     *
     * @return null|bool 削除が成功したらtrue, 失敗したらfalseを返す
     */
    public function deleteById(int $id): ?bool
    {
        return $this->model
            ->where('id', $id)
            ->delete();
    }
}

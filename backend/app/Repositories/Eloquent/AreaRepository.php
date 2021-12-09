<?php

namespace App\Repositories\Eloquent;

use App\Models\Area;
use App\Repositories\AreaRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Areaモデルを操作するリポジトリクラス
 */
final class AreaRepository implements AreaRepositoryInterface
{

    private $model;

    /**
     * @param object $model
     */
    public function __construct(AreaRepositoryInterface $model)
    {
        $this->model = $model;
    }

    /**
     * idで検索するためのメソッド。
     *
     * @param integer $id
     * @return Area|null
     */
    public function findById(int $id): ?Area
    {
        return $this->model
            ->where('id', $id)
            ->first();
    }

    /**
     * 全てのエリアを取得するためのメソッド。
     *
     * @return Collection
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
     * @return Area 保存した内容を返す
     */
    public function create(array $savingAssoc): Area
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

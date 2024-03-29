<?php

namespace App\Repositories\Eloquent;

use App\Models\Ability;
use App\Repositories\AbilityRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Abilityモデルを操作するリポジトリクラス
 */
final class AbilityRepository implements AbilityRepositoryInterface
{

    private $model;

    /**
     * @param object $model
     */
    public function __construct(AbilityRepositoryInterface $model)
    {
        $this->model = $model;
    }

    /**
     * idで検索するためのメソッド。
     *
     * @param integer $id
     * @return Ability|null
     */
    public function findById(int $id): ?Ability
    {
        return $this->model
            ->where('id', $id)
            ->first();
    }

    /**
     * user_language_idを元に全件取得するためのメソッド。
     *
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
     * @return Ability 保存した内容を返す
     */
    public function create(array $savingAssoc): Ability
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

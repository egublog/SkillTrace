<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;

/**
 * Userモデルを操作するリポジトリクラス
 */
final class UserRepository implements UserRepositoryInterface
{

    private $model;

    /**
     * @param object $model
     */
    public function __construct(UserRepositoryInterface $model)
    {
        $this->model = $model;
    }

    /**
     * idで検索するためのメソッド。
     *
     * @param integer $id
     * @return User|null
     */
    public function findById(int $id): ?User
    {
        return $this->model
            ->where('id', $id)
            ->first();
    }

    /**
     * 保存するためのメソッド。
     *
     * @param array $savingAssoc 保存する対象の連想配列
     *                           [
     *                           ]
     *
     * @return User 保存した内容を返す
     */
    public function create(array $savingAssoc): User
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

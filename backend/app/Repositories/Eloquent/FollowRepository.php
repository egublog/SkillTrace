<?php

namespace App\Repositories\Eloquent;

use App\Models\Follow;
use App\Repositories\FollowRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

final class FollowRepository implements FollowRepositoryInterface
{

    private $model;

    /**
     * @param object $model
     */
    public function __construct(FollowRepositoryInterface $model)
    {
        $this->model = $model;
    }

    /**
     * idで検索するためのメソッド。
     *
     * @param integer $id
     * @return Follow|null
     */
    public function findById(int $id): ?Follow
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
     * @return Follow 保存した内容を返す
     */
    public function create(array $savingAssoc): Follow
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
     * user_idをもとに絞り込むためのメソッド
     *
     * @param int $userId
     *
     * @return Collection
     */
    public function getByUserId(int $userId): Collection
    {
        return $this->model->where('user_id', $userId)->get();
    }

    /**
     * user_to_idをもとに絞り込むためのメソッド
     *
     * @param int $userToId
     *
     * @return Collection
     */
    public function getByUserToId(int $userToId): Collection
    {
        return $this->model->where('user_to_id', $userToId)->get();
    }

    /**
     * user_idとuser_to_idをもとに絞り込むためのメソッド
     *
     * @param int $userId, $userToId
     *
     * @return Follow|null
     */
    public function getByUserIdAndUserToId(int $userId, int $userToId): ?Follow
    {
        return $this->model->where('user_id', $userId)->where('user_to_id', $userToId)->first();
    }

    /**
     * 自分がその人をフォローしているかどうかの判定
     * FIXME: 本来であればこのメソッドはRepository層ではないので、後々Service層orUseCase層に移動する
     *
     * @param Follow|null $followCheck
     *
     * @return void
     */
    public function followCheck(?Follow $followCheck): void
    {
        if ($followCheck == null) {
            $followCheck = false;
        } else {
            $followCheck = true;
        }
    }
}

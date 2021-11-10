<?php

namespace App\Repositories\Eloquent;

use App\Models\Talk;
use App\Repositories\TalkRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

final class TalkRepository implements TalkRepositoryInterface
{

    private $model;

    /**
     * @param object $model
     */
    public function __construct(TalkRepositoryInterface $model)
    {
        $this->model = $model;
    }

    /**
     * idで検索するためのメソッド。
     *
     * @param integer $id
     * @return Talk|null
     */
    public function findById(int $id): ?Talk
    {
        return $this->model
            ->where('id', $id)
            ->first();
    }

    /**
     * user_idを元に全てのTalkを取得するためのメソッド。
     *
     * @param int $userId
     * @return Collection
     */
    public function getByUserId(int $userId): Collection
    {
        return $this->model
            ->where('user_id', $userId)
            ->get();
    }

    /**
     * user_to_idを元に全てのTalkを取得するためのメソッド。
     *
     * @param int $userToId
     * @return Collection
     */
    public function getByUserToId(int $userToId): Collection
    {
        return $this->model
            ->where('user_to_id', $userToId)
            ->get();
    }

    /**
     * user_idとuser_to_idを元に全てのTalkを取得するためのメソッド。
     *
     * @param int $userId
     * @param int $userToId
     * @return Collection
     */
    public function getByUserIdOrUserToId(int $userId, int $userToId): Collection
    {
        return $this->model
            ->where('user_id', $userId)
            ->orWhere('user_to_id', $userToId)
            ->get();
    }

    /**
     * user_idを元に全てのTalkを最新順に取得するためのメソッド。
     *
     * @param int $userId
     * @return Collection
     */
    public function getLatestByUserIdOrUserToId(int $userId): Collection
    {
        return $this->model
            ->where('user_id', $userId)
            ->orWhere('user_to_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * theFriendIdのuserと話しているTalk全てを取得するためのメソッド。
     *
     * @param int $userId
     * @param int $theFriendId
     * @return Collection
     */
    public function getTalkByTheFriendId(int $userId, int $theFriendId): Collection
    {
        return $this->model
            ->where('user_id', $userId)
            ->where('user_to_id', $theFriendId)
            ->orWhere(function($q) use ($theFriendId, $userId) {
                $q->where('user_id', $theFriendId)
                    ->where('user_to_id', $userId);
            })->get();
    }

    /**
     * 保存するためのメソッド。
     *
     * @param array $savingAssoc 保存する対象の連想配列
     *                           [
     *                           ]
     *
     * @return Talk 保存した内容を返す
     */
    public function create(array $savingAssoc): Talk
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

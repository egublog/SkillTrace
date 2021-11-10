<?php

namespace App\Repositories\Eloquent;

use App\Models\UserLanguage;
use App\Repositories\UserLanguageRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

final class UserLanguageRepository implements UserLanguageRepositoryInterface
{

    private $model;

    /**
     * @param object $model
     */
    public function __construct(UserLanguageRepositoryInterface $model)
    {
        $this->model = $model;
    }

    /**
     * idで検索するためのメソッド。
     *
     * @param integer $id
     * @return UserLanguage|null
     */
    public function findById(int $id): ?UserLanguage
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
     * @return UserLanguage 保存した内容を返す
     */
    public function create(array $savingAssoc): UserLanguage
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
     *
     * @param int $userId, $languageId
     *
     * @return UserLanguage|null
     */
    public function findByUserIdAndLanguageId(int $userId, int $languageId): ?UserLanguage
    {
        return $this->model->where('user_id', $userId)->where('language_id', $languageId)->first();
    }

    /**
     *
     * @param int $userId
     *
     * @return Collection
     */
    public function findByUserIdAndAscByLanguageId(int $userId): Collection
    {
        return $this->model->where('user_id', $userId)->orderBy('language_id', 'asc')->get();
    }

    /**
     *
     * @param int $userId
     *
     * @return Collection
     */
    public function findByUserIdAndGetLanguageId(int $userId): Collection
    {
        return $this->model->where('user_id', $userId)->get(['language_id']);
    }
}

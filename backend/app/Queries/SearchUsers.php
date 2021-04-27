<?php

namespace App\Queries;

use App\Models\User;

final class SearchUsers
{
  /**
   * @return \Illuminate\Database\Query\Builder
   */
  public static function search($myId, $name, $age, $areId, $historyId, $languageId)
  {
    return User::whereNotIn('id', [$myId])
      ->when($name, function ($query) use ($name) {
        return $query->where('name', 'like', "%$name%");
      })
      ->when($age, function ($query) use ($age) {
        return $query->where('age', $age);
      })
      ->when($areId, function ($query) use ($areId) {
        return $query->where('area_id', $areId);
      })
      ->when($historyId, function ($query) use ($historyId) {
        return $query->where('history_id', $historyId);
      })
      ->when($languageId, function ($query) use ($languageId) {
        return $query->where('language_id', $languageId);
      });
  }
}

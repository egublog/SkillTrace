<?php

namespace App\Queries;

use App\Models\User;

final class SearchUsers
{
  /**
   * @return \App\Models\User[]
   */
  public static function get($myId, $name, $age, $area_id, $history_id, $language_id)
  {
    return User::whereNotIn('id', [$myId])
      ->when($name, function ($query) use ($name) {
        return $query->where('name', 'like', "%$name%");
      })
      ->when($age, function ($query) use ($age) {
        return $query->where('age', 'like', "%$age%");
      })
      ->when($area_id, function ($query) use ($area_id) {
        return $query->where('area_id', 'like', "%$area_id%");
      })
      ->when($history_id, function ($query) use ($history_id) {
        return $query->where('history_id', 'like', "%$history_id%");
      })
      ->when($language_id, function ($query) use ($language_id) {
        return $query->where('language_id', 'like', "%$language_id%");
      })
      ->get();
  }
}

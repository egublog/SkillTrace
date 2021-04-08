<?php

namespace App\Queries;

use App\Models\Follow;

final class SearchFollowing
{
  /**
   * @return \Illuminate\Database\Query\Builder
   */
  public static function search($myId, $name)
  {
    return Follow::following($myId)
      ->whereHas('user_following', function ($query) use ($name) {
        $query->where('name', 'like', "%$name%");
      });
  }
}

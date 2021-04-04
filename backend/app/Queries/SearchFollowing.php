<?php

namespace App\Queries;

use App\Models\Follow;

final class SearchFollowing
{
  /**
   * @return \App\Models\Follow[]
   */
  public static function get($myId, $name)
  {
    return Follow::following($myId)
      ->whereHas('user_following', function ($query) use ($name) {
        $query->where('name', 'like', "%$name%");
      })
      ->get();
  }
}

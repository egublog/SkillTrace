<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\User_language;
use App\Models\Follow;

class FollowingController extends Controller
{
    public function index($userId)
    {
        $myId = Auth::id();
        $myAccount = User::find($myId);

        $followings = Follow::where('user_id', $userId)->get();

        return view('MyService.friends_list', compact('myId', 'followings', 'userId'));
    }

    // public function follow($userId)
    // {
    //     $myId = Auth::id();
    //     $myAccount = User::find($myId);
    //     // $account = User::find($userId);

    //     // $languages = User_language::where('user_id', $userId)->get();

    //     $the_following = Follow::where('user_id', $myId)->where('user_to_id', $userId)->first();
    //     // getは配列だから、取り出す時注意
    //     // firstは単体
        
    //     if (isset($the_following)) {
    //         $myAccount->follow()->detach($userId);
    //     } else {
    //         $myAccount->follow()->attach($userId);
    //         // $following = new Follow;
    //         // $following->user_id = $myId;
    //         // $following->user_to_id = $friendId;
    //         // $following->save();
    //     }


    //     // なぜか最後にもう一度the_followingを定義しないとうまく動かない
    //     // $the_following = Follow::where('user_id', $myId)->where('user_to_id', $userId)->first();

    //     return redirect()->route('home.friend_home', ['friendId' => $userId]);
        
    //     // ->with([
    //     //     'myId' => $myId,
    //     //     'account' => $account,
    //     //     'languages' => $languages,
    //     //     'the_following' => $the_following,
    //     //     'userId' => $userId
    //     // ]);

    //     // return view('MyService.home')->with([
    //     //     'myId' => $myId,
    //     //     'account' => $account,
    //     //     'languages' => $languages,
    //     //     'follow_check' => $the_following,
    //     //     'userId' => $userId
    //     // ]);
    // }

    public function follow($userId)
    {
        $myId = Auth::id();
        $myAccount = User::find($myId);
        $the_following = Follow::where('user_id', $myId)->where('user_to_id', $userId)->first();


        // if (isset($the_following)) {
        //     $myAccount->follow()->detach($userId);
        // } else {
        //     $myAccount->follow()->attach($userId);
        //     // $following = new Follow;
        //     // $following->user_id = $myId;
        //     // $following->user_to_id = $friendId;
        //     // $following->save();
        // }

        $myAccount->follow()->attach($userId);

        return response()->json([]);
    }
    public function unfollow($userId)
    {
        $myId = Auth::id();
        $myAccount = User::find($myId);
        $the_following = Follow::where('user_id', $myId)->where('user_to_id', $userId)->first();
        // if (isset($the_following)) {
        //     $myAccount->follow()->detach($userId);
        // } else {
        //     $myAccount->follow()->attach($userId);
        //     // $following = new Follow;
        //     // $following->user_id = $myId;
        //     // $following->user_to_id = $friendId;
        //     // $following->save();
        // }

        $myAccount->follow()->detach($userId);

        return response()->json([]);
    }
}

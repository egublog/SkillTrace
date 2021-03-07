<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\User;
use App\Area;
use App\History;
use App\Language;
use App\User_language;
use App\Follow;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $myId = Auth::id();
        $account = User::find($myId);

        return view('home')->with([
            'myId' => $myId,
            'account' => $account
        ]);
    }

    public function my_home()
    {
        $myId = Auth::id();
        $account = User::find($myId);
        $languages = User_language::where('user_id', $myId)->get();

        

        return view('MyService.home')->with([
            'account' => $account,
            'myId' => $myId,
            'languages' => $languages,
        ]);
    }

    public function friend_home(Request $request)
    {
        $myId = Auth::id();
        $friendId = $request->id;
        $friend_account = User::find($friendId);
        $languages = User_language::where('user_id', $friendId)->get();

        $follow_check = Follow::where('user_id', $myId)->where('user_to_id', $friendId)->first();

        return view('MyService.home')->with([
            'account' => $friend_account,
            'myId' => $myId,
            'languages' => $languages,
            'follow_check' => $follow_check
        ]);
    }


    // profile

    public function profile()
    {
        $myId = Auth::id();
        $myAccount = User::find($myId);
        $areas = Area::all();
        $histories = History::all();
        $languages = Language::all();

        return view('MyService.profile')->with([
            'areas' => $areas,
            'histories' => $histories,
            'languages' => $languages,
            'myId' => $myId,
            'myAccount' => $myAccount
        ]);
    }

    public function profile_save(Request $request)
    {
        $myId = Auth::id();
        $account = User::find($myId);


        $columns = ['name', 'age', 'area_id', 'history_id', 'language_id'];

        foreach ($columns as $column) {
            if (isset($request->$column)) {
                $account->$column = $request->$column;
            }
        }
        // もっと効率の良いやり方アリそう
        $account->save();

        $languages = User_language::where('user_id', $myId)->get();


        return view('MyService.home')->with([
            'languages' => $languages,
            'account' => $account,
            'myId' => $myId
        ]);
    }

    public function profile_img_save(Request $request) {
        $user_img = $request->file('profile_img');

        $myId = Auth::id();
        $myAccount = User::find($myId);

        $areas = Area::all();
        $histories = History::all();
        $languages = Language::all();

        // $file_name = $myId . '.jpeg';
        // $user_img->storeAs('public/profile_images', $file_name);

        $path = Storage::disk('s3')->putFile('profile_img', $user_img, 'public');
        $myAccount->img = Storage::disk('s3')->url($path);

        // $myAccount->img = $file_name;
        $myAccount->save();

        return redirect('/profile')->with([
            'areas' => $areas,
            'histories' => $histories,
            'languages' => $languages,
            'myId' => $myId,
            'myAccount' => $myAccount
        ]);
    }
    // friends

    public function follower_list(Request $request)
    {
        $myId = Auth::id();
        $myAccount = User::find($myId);

        $userId = $request->input('follower');



        $followers = Follow::where('user_to_id', $userId)->get();


        return view('MyService.friends_list')->with([
            'followers' => $followers,
            'userId' => $userId
        ]);
    }

    public function following_list(Request $request)
    {
        $myId = Auth::id();
        $myAccount = User::find($myId);

        $userId = $request->input('following');


        $followings = Follow::where('user_id', $userId)->get();


        return view('MyService.friends_list')->with([
            'followings' => $followings,
            'userId' => $userId
        ]);
    }

    public function following(Request $request)
    {
        $myId = Auth::id();
        $myAccount = User::find($myId);

        $friendId = $request->id;
        $account = User::find($friendId);

        $languages = User_language::where('user_id', $friendId)->get();

        $the_following = Follow::where('user_id', $myId)->where('user_to_id', $friendId)->first();
        // getは配列だから、取り出す時注意
        // firstは単体

        if (isset($the_following)) {
            $myAccount->follow()->detach($friendId);
        } else {
            $myAccount->follow()->attach($friendId);
            // $following = new Follow;
            // $following->user_id = $myId;
            // $following->user_to_id = $friendId;
            // $following->save();
        }


        // なぜか最後にもう一度the_followingを定義しないとうまく動かない
        $the_following = Follow::where('user_id', $myId)->where('user_to_id', $friendId)->first();




        return view('MyService.home')->with([
            'account' => $account,
            'myId' => $myId,
            'languages' => $languages,
            'follow_check' => $the_following
        ]);
    }
}

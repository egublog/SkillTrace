<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Area;
use App\Models\History;
use App\Models\Language;
use App\Queries\SearchUsers;


class SearchController extends Controller
{
    //
    public function index()
    {
        $myId = Auth::id();
        $areas = Area::all();
        $histories = History::all();
        $languages = Language::all();


        return view('MyService.search', compact('myId', 'areas', 'histories', 'languages'));
    }

    public function search(Request $request) {

        $myId = Auth::id();

        $areas = Area::all();
        $histories = History::all();
        $languages = Language::all();

        $name = $request->input('name');
        $age = $request->input('age');
        $area_id = $request->input('area_id');
        $history_id = $request->input('history_id');
        $language_id = $request->input('language_id');

        $request->flash();

        // $search_result_users = User::
        //     //自分のレコードは含めない
        //     whereNotIn('id', [$myId])
        //     //名前が入力されていたら
        //     ->searchName($name)
        //     // 年齢が入力されていたら
        //     ->searchAge($age)
        //     // 住所が入力されていたら
        //     ->searchArea($area_id)
        //     // エンジニア歴が入力されていたら
        //     ->searchHistory($history_id)
        //     // 得意言語が入力されていたら
        //     ->searchLanguage($language_id)

        //     ->get();

        $search_result_users = SearchUsers::get($myId, $name, $age, $area_id, $history_id, $language_id);

        return view('MyService.search', compact('myId', 'areas', 'histories', 'languages', 'search_result_users'));
    }
}

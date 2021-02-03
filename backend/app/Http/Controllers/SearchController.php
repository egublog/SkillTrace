<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\User;
use App\Area;
use App\History;
use App\Language;


class SearchController extends Controller
{
    //
    public function search()
    {
        $areas = Area::all();
        $histories = History::all();
        $languages = Language::all();


        return view('MyService.search')->with([
            'areas' => $areas,
            'histories' => $histories,
            'languages' => $languages,


        ]);
    }

    public function search_result(Request $request) {

        $myId = Auth::id();

        $areas = Area::all();
        $histories = History::all();
        $languages = Language::all();

        $name = $request->input('name');
        $age = $request->input('age');
        $area_id = $request->input('area_id');
        $history_id = $request->input('history_id');
        $language_id = $request->input('language_id');


        $search_result_users = User::
            //自分のレコードは含めない
            whereNotIn('id', [$myId])
            //名前が入力されていたら以下を実行
            ->when($name, function ($query) use ($name) {
            return $query->where('name', 'like', "%$name%"); 
            })
            // 年齢が入力されていたら以下を実行
            ->when($age, function ($query) use ($age) {
            return $query->where('age', $age); 
            })
            // 住所が入力されていたら以下を実行
            ->when($area_id, function ($query) use ($area_id) {
            return $query->where('area_id', $area_id); 
            })
            // エンジニア歴が入力されていたら以下を実行
            ->when($history_id, function ($query) use ($history_id) {
            return $query->where('history_id', $history_id); 
            })
            // 得意言語が入力されていたら以下を実行
            ->when($language_id, function ($query) use ($language_id) {
            return $query->where('language_id', $language_id); 
            })
            ->get();

           


        // $user__name__ = User::where('name', $request->name);

        // $search_result_name =  $user->where('name', $request->name);
        
            //    $requestはプロパティの名前がname属性, ユーザーが入力した物はプロパティの中身のオブジェクト

        return view('MyService.search')->with([
            'areas' => $areas,
            'histories' => $histories,
            'languages' => $languages,
            'search_result_users' => $search_result_users
        ]);
    }
}

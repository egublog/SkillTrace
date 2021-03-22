<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\ProfileImageRequest;
use App\Models\User;
use App\Models\Area;
use App\Models\History;
use App\Models\Language;
use App\Models\User_language;

class ProfileController extends Controller
{

        public function index()
        {
            $myId = Auth::id();
            $myAccount = User::find($myId);
            $areas = Area::all();
            $histories = History::all();
            $languages = Language::all();
    
            return view('MyService.profile', compact('myId', 'areas', 'histories', 'languages', 'myAccount'));
        }
    
        public function store(Request $request)
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
    
            // $languages = User_language::where('user_id', $myId)->get();
    
            return redirect()->route('home.home', ['userId' => $myId]);
            
            
            // ->with([
            //     'myId' => $myId,
            //     'account' => $account,
            //     'languages' => $languages
            // ]);
        }
    
        public function img_store(Request $request) {

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
    
            return redirect()->route('profile.index');
            
            // ->with([
            //     'myId' => $myId,
            //     'areas' => $areas,
            //     'histories' => $histories,
            //     'languages' => $languages,
            //     'myAccount' => $myAccount
            // ]);
        }
}

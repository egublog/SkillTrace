<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// 
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/activity', 'ActivityController@activity');

Route::get('/search', 'SearchController@search');
Route::post('/search', 'SearchController@search_result');


// Route::get('/my_home', 'HomeController@my_home');
Route::get('/my_home', 'HomeController@my_home')->name('home.my_home');

Route::post('/friend_home', 'HomeController@friend_home');

Route::get('/profile', 'HomeController@profile');
Route::post('/profile', 'HomeController@profile_save');
Route::post('/profile_img', 'HomeController@profile_img_save');

Route::get('/follower_list', 'HomeController@follower_list');
Route::get('/following_list', 'HomeController@following_list');
Route::post('/friend_home/following', 'HomeController@following');



Route::get('/talk', 'TalkController@talk');
Route::post('/talk_search', 'TalkController@talk_search');
Route::get('/talk_show', 'TalkController@talk_show');
Route::post('/talk_show', 'TalkController@talk_content');


Route::post('/skill_item', 'SkillController@skill_item');
Route::get('/skill_add', 'SkillController@skill_add');

Route::post('/skill_edit_add_star', 'SkillController@skill_edit_add_star');
Route::post('/skill_edit_add_able', 'SkillController@skill_edit_add_able');
Route::post('/skill_edit_add_trace', 'SkillController@skill_edit_add_trace');

Route::post('/skillable_edit', 'SkillController@skillable_edit');
Route::post('/skillable_edit_redirect', 'SkillController@skillable_edit_redirect');
Route::post('/skillable_delete', 'SkillController@skillable_delete');


Route::post('/skill_trace_edit', 'SkillController@skill_trace_edit');
Route::post('/skill_trace_edit_redirect', 'SkillController@skill_trace_edit_redirect');
Route::post('/skill_trace_delete', 'SkillController@skill_trace_delete');

Route::post('/skill_edit_star', 'SkillController@skill_edit_star');
Route::post('/skill_edit_able', 'SkillController@skill_edit_able');
Route::post('/skill_edit_trace', 'SkillController@skill_edit_trace');

Route::post('/skill_add_save', 'SkillController@skill_add_save');
Route::post('/home/skill_delete', 'SkillController@skill_delete');

// Route::post('/skill_list_add', 'SkillController@skill_list_add');



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

//home

Route::get('/user/{userId}', 'HomeController@home')->name('home.home');
// Route::get('/user/{userId}', 'HomeController@my_home')->name('home.my_home');
// Route::get('/friend/{friendId}', 'HomeController@friend_home')->name('home.friend_home');

//profile
Route::get('/profile', 'ProfileController@index')->name('profile.index');
Route::post('/profile/store', 'ProfileController@store')->name('profile.store');
Route::post('/profile/img_store', 'ProfileController@img_store')->name('profile.img_store');

//activity
Route::get('/activity', 'ActivityController')->name('activity');

//search
Route::get('/search', 'SearchController@index')->name('search.index');
Route::get('/search/result', 'SearchController@search')->name('search.search');

//followers
Route::get('/user/{userId}/followers', 'FollowerController@index')->name('follower.index');

//following
Route::get('/user/{userId}/following', 'FollowingController@index')->name('following.index');
// Route::post('/user/{userId}/aa', 'FollowingController@follow')->name('following.follow');
Route::post('/user/{userId}/follow', 'FollowingController@follow');
Route::post('/user/{userId}/unfollow', 'FollowingController@unfollow');


//talk
Route::get('/talk', 'TalkController@index')->name('talk.index');
Route::get('/talk/search', 'TalkController@search')->name('talk.search');
Route::get('/talk/{theFriendId}', 'TalkController@show')->name('talk.show');
Route::post('/talk/{theFriendId}/store', 'TalkController@store')->name('talk.store');

//skill
Route::get('/user/{userId}/skill/{skillId}', 'SkillController@show')->name('skill.show');
Route::get('/user/skill/create', 'SkillController@create')->name('skill.create');
Route::post('/user/skill/create', 'SkillController@store')->name('skill.store');
Route::delete('/user/skill/{userLanguageId}', 'SkillController@destroy')->name('skill.destroy');

//star
Route::get('/user/{userLanguageId}/star', 'SkillStarController@create')->name('skillStar.create');
Route::put('/user/{userLanguageId}/star', 'SkillStarController@update')->name('skillStar.update');

//ability
Route::get('/user/{userLanguageId}/ability', 'SkillAbilityController@create')->name('skillAbility.create');
Route::post('/user/{userLanguageId}/ability', 'SkillAbilityController@store')->name('skillAbility.store');
Route::get('/user/{userLanguageId}/ability/{abilityId}', 'SkillAbilityController@show')->name('skillAbility.show');
Route::put('/user/{userLanguageId}/ability/{abilityId}', 'SkillAbilityController@update')->name('skillAbility.update');
Route::delete('/user/{userLanguageId}/ability/{abilityId}', 'SkillAbilityController@destroy')->name('skillAbility.destroy');

//trace
Route::get('/user/{userLanguageId}/trace', 'SkillTraceController@create')->name('skillTrace.create');
Route::post('/user/{userLanguageId}/trace', 'SkillTraceController@store')->name('skillTrace.store');
Route::get('/user/{userLanguageId}/trace/{traceId}', 'SkillTraceController@show')->name('skillTrace.show');
Route::put('/user/{userLanguageId}/trace/{traceId}', 'SkillTraceController@update')->name('skillTrace.update');
Route::delete('/user/{userLanguageId}/trace/{traceId}', 'SkillTraceController@destroy')->name('skillTrace.destroy');


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
Route::group(['prefix' => 'profile'], function() {
    Route::get('/', 'ProfileController@index')->name('profile.index');
    Route::post('/store', 'ProfileController@store')->name('profile.store');
    Route::post('/img_store', 'ProfileController@img_store')->name('profile.img_store');
});

//activity
Route::get('/activity', 'ActivityController')->name('activity');

//search
Route::group(['prefix' => 'search'], function() {

    Route::get('/', 'SearchController@index')->name('search.index');
    Route::get('/result', 'SearchController@search')->name('search.search');

});

//followers
Route::get('/user/{userId}/followers', 'FollowerController@index')->name('follower.index');

//following
Route::group(['prefix' => 'user/{userId}'], function() {

    Route::get('/following', 'FollowingController@index')->name('following.index');
    Route::post('/follow', 'FollowingController@follow');
    Route::post('/unfollow', 'FollowingController@unfollow');

});
// Route::post('/user/{userId}/aa', 'FollowingController@follow')->name('following.follow');


//talk
Route::group(['prefix' => 'talk'], function() {

    Route::get('/', 'TalkController@index')->name('talk.index');
    Route::get('/search', 'TalkController@search')->name('talk.search');
    Route::get('/{theFriendId}', 'TalkController@show')->name('talk.show');
    Route::post('/{theFriendId}/store', 'TalkController@store')->name('talk.store');

});

//skill
Route::group(['prefix' => 'user'], function() {

    Route::get('/{userId}/skill/{skillId}', 'SkillController@show')->name('skill.show');
    Route::get('/skill/create', 'SkillController@create')->name('skill.create');
    Route::post('/skill/create', 'SkillController@store')->name('skill.store');
    Route::delete('/skill/{userLanguageId}', 'SkillController@destroy')->name('skill.destroy');

});

//star
Route::group(['prefix' => 'user/{userLanguageId}/star'], function() {

    Route::get('/', 'SkillStarController@create')->name('skillStar.create');
    Route::put('/', 'SkillStarController@update')->name('skillStar.update');

});

//ability
Route::group(['prefix' => 'user/{userLanguageId}/ability'], function() {

    Route::get('/', 'SkillAbilityController@create')->name('skillAbility.create');
    Route::post('/', 'SkillAbilityController@store')->name('skillAbility.store');
    Route::get('/{abilityId}', 'SkillAbilityController@show')->name('skillAbility.show');
    Route::put('/{abilityId}', 'SkillAbilityController@update')->name('skillAbility.update');
    Route::delete('/{abilityId}', 'SkillAbilityController@destroy')->name('skillAbility.destroy');

});

//trace
Route::group(['prefix' => 'user/{userLanguageId}/trace'], function() {

    Route::get('/', 'SkillTraceController@create')->name('skillTrace.create');
    Route::post('/', 'SkillTraceController@store')->name('skillTrace.store');
    Route::get('/{traceId}', 'SkillTraceController@show')->name('skillTrace.show');
    Route::put('/{traceId}', 'SkillTraceController@update')->name('skillTrace.update');
    Route::delete('/{traceId}', 'SkillTraceController@destroy')->name('skillTrace.destroy');
    
});


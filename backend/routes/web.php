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
Route::get('/users/{userId}', 'HomeController@home')->name('home.home');

//profile
Route::group(['prefix' => 'profiles', 'as' => 'profiles.'], function() {

    Route::get('/', 'ProfileController@index')->name('index');
    Route::post('/store', 'ProfileController@store')->name('store');
    Route::post('/img_store', 'ProfileController@img_store')->name('img_store');
    
});

//activity
Route::get('/activities', 'ActivityController')->name('activities');

//search
Route::group(['prefix' => 'searches', 'as' => 'searches.'], function() {

    Route::get('/', 'SearchController@index')->name('index');
    Route::get('/result', 'SearchController@search')->name('search');

});

//followers
Route::get('/users/{userId}/followers', 'FollowerController@index')->name('followers.index');

//following
Route::group(['prefix' => 'users/{userId}', 'as' => 'following.'], function() {

    Route::get('/following', 'FollowingController@index')->name('index');
    Route::post('/follow', 'FollowingController@follow');
    Route::post('/unfollow', 'FollowingController@unfollow');

});


//talk
Route::group(['prefix' => 'talks', 'as' => 'talks.'], function() {

    Route::get('/', 'TalkController@index')->name('index');
    Route::get('/search', 'TalkController@search')->name('search');
    Route::get('/{theFriendId}', 'TalkController@show')->name('show');
    Route::post('/{theFriendId}/store', 'TalkController@store')->name('store');

});

//skill
Route::group(['prefix' => 'users', 'as' => 'skills.'], function() {

    Route::get('/{userId}/skills/{skillId}', 'SkillController@show')->name('show');
    Route::get('/skills/create', 'SkillController@create')->name('create');
    Route::post('/skills/create', 'SkillController@store')->name('store');
    Route::delete('/skills/{userLanguageId}', 'SkillController@destroy')->name('destroy');

});

//star
Route::group(['prefix' => 'users/{userLanguageId}/stars', 'as' => 'skill_stars.'], function() {

    Route::get('/', 'SkillStarController@create')->name('create');
    Route::put('/', 'SkillStarController@update')->name('update');

});

//ability
Route::group(['prefix' => 'users/{userLanguageId}/abilities', 'as' => 'skill_abilities.'], function() {

    Route::get('/', 'SkillAbilityController@create')->name('create');
    Route::post('/', 'SkillAbilityController@store')->name('store');
    Route::get('/{abilityId}', 'SkillAbilityController@show')->name('show');
    Route::put('/{abilityId}', 'SkillAbilityController@update')->name('update');
    Route::delete('/{abilityId}', 'SkillAbilityController@destroy')->name('destroy');

});

//trace
Route::group(['prefix' => 'users/{userLanguageId}/traces', 'as' => 'skill_traces.'], function() {

    Route::get('/', 'SkillTraceController@create')->name('create');
    Route::post('/', 'SkillTraceController@store')->name('store');
    Route::get('/{traceId}', 'SkillTraceController@show')->name('show');
    Route::put('/{traceId}', 'SkillTraceController@update')->name('update');
    Route::delete('/{traceId}', 'SkillTraceController@destroy')->name('destroy');
    
});


<?php

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
Route::get('/test',function (){
    dd(Wang::test());
    //dd(app()->make('wang')->test());
});
Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    return view('home');
});
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/string', 'HomeController@redisString')->name('string');
Route::get('/push', 'HomeController@redisPush')->name('push');
Route::get('/set', 'HomeController@redisSet')->name('set');
Route::get('/zset', 'HomeController@redisZset')->name('zset');
Route::get('/hash', 'HomeController@redisHash')->name('hash');
Route::get('/sort', 'HomeController@redisSort')->name('sort');

Route::group(['prefix'=>'api/v1'],function (){
    Route::resource('lessons', 'LessonsController');
});
Auth::routes();



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

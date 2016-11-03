<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/','HelloController@index');
Route::get('/del','HelloController@del');
Route::get('/message','HelloController@message');
Route::post('/message','HelloController@message');
Route::post('/namely','HelloController@namely');
Route::post('/delete','HelloController@delete');
Route::get('/img1','HelloController@img1');
Route::post('/img','HelloController@img');
Route::get('/', function (){
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});
/*Route::get('user/{name}', function ($name='shapolang') {    return 'Hello '.$name;});*/

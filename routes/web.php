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

Auth::routes();

Route::group(['middleware'=>['auth'], 'namespace'=>'CRM'], function(){
  Route::redirect('/', '/profile', 301);
  Route::get('/profile', 'ProfileController@show')->name('profile');
  Route::put('/profile/{id}', 'ProfileController@update')->name('profile.update');
  Route::put('/profile/{id}/changepass', 'ProfileController@changepass')->name('profile.changepass');

  Route::resource('/messages', 'MessageController');
  Route::resource('/board', 'BoardController');

  Route::post('/board/{board}/group', 'GroupController@store')->name('group.store');
  Route::put('/board/{board}/group/{group}', 'GroupController@update')->name('group.update');
  Route::delete('/board/{board}/group/{group}', 'GroupController@destroy')->name('group.destroy');

  Route::post('/board/{board}/group/{group}/task', 'TaskController@store')->name('task.store');
  Route::put('/board/{board}/group/{group}/task/{task}', 'TaskController@update')->name('task.update');

  Route::get('/task/{task}/users', 'TaskController@users')->name('task.users');
  Route::put('/task/{task}/users', 'TaskController@usersSync')->name('task.usersSync');

  Route::get('/task/{task}/comments', 'TaskController@comments')->name('task.comments');
  Route::post('/task/{task}/comments', 'TaskController@commentsStore')->name('task.commentsStore');
});

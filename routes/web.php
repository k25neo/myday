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
});

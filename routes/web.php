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

Route::get('/', 'Auth\LoginController@showLoginForm')->name('index');

Auth::routes();
//
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/accountsettings', 'HomeController@accountSettings')->name('accountsettings');

Route::post('/accountsettingssave', 'HomeController@accountSettingsSave')->name('accountsettingssave');

Route::get('/myprofile', 'HomeController@myProfile')->name('myprofile');

Route::get('/profileedit', 'HomeController@myProfileEdit')->name('profileedit');

Route::post('/profileupdate', 'HomeController@profileUpdate')->name('profileupdate');

Route::get('/mindset', 'HomeController@mindset')->name('mindset');


Route::get('auth/facebook', 'Auth\FacebookController@redirectToFacebook');

Route::get('auth/facebook/callback', 'Auth\FacebookController@handleFacebookCallback');

Route::get('/userslist', 'UserController@usersList')->name('userslist');
Route::get('/users', 'UserController@users')->name('users');
Route::delete('/users/delete/{id}', 'UserController@usersDelete')->name('users.delete');
Route::match(array('get', 'post'), '/users/edit/{id}', 'UserController@usersEdit')->name('users.edit');

Route::match(array('get', 'post'), '/role/create', 'RoleController@create')->name('role.create');
Route::post('/rolemodify', 'RoleController@roleModify')->name('role.modify');

Route::match(array('get', 'post'), '/module/create', 'ModuleController@create')->name('module.create');


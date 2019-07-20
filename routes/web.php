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

Route::match(array('get', 'post'), 'admin/login', 'Auth\AdminLoginController@login')->name('admin.login');
Route::get('/adminhome', 'HomeController@adminHome')->name('adminhome');

Route::get('/adminforgotpassword', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.forgotpassword');
Route::match(array('get', 'post'), '/adminpasswordsent', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.passwordsent');


Route::get('/adminresetforgotpassword', 'Auth\AdminResetPasswordController@index')->name('admin.resetpassword');

Route::get('/admin', 'AdminController@index');

Route::prefix('admin')->group(function() {

    // admin password resset routes
    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');

    Route::get('/userslist', 'UserController@usersList')->name('admin.userslist');
    Route::get('/logout', 'UserController@adminLogout')->name('admin.logout');
    Route::get('/dashboard', 'HomeController@adminHome')->name('admin.dashboard');

    Route::delete('/users/changeactivity/{id}', 'UserController@usersActivityChange')->name('admin.users.activity.change');
    Route::post('/rolesave', 'RoleController@roleNew')->name('admin.role.save');

    Route::get('/system', 'SystemController@index')->name('admin.system');
    Route::post('/level/save', 'SystemController@newLevel')->name('admin.level.save');
    Route::delete('/level/delete/{id}', 'SystemController@deleteLevel')->name('admin.level.delete');
});



Auth::routes();
//
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/myprofile', 'HomeController@myProfile')->name('myprofile');
Route::get('/myprofile/edit', 'HomeController@myProfileEdit')->name('myprofile.edit');
Route::post('/profileupdate', 'HomeController@profileUpdate')->name('myprofile.update');


Route::post('/users/search', 'HomeController@usersSearchSuggestions')->name('users.search');
Route::get('/users/search/result', 'HomeController@usersSearchResult')->name('users.search.result');
Route::get('/other/profile/view/{id}', 'HomeController@otherProfileView')->name('other.profile.view');
Route::post('/user/follow', 'HomeController@followUser')->name('user.follow');
Route::post('/user/follow', 'HomeController@followUser')->name('user.follow');
Route::post('/user/followers/all', 'HomeController@followersAll')->name('user.followers.all');



Route::get('/accountsettings', 'HomeController@accountSettings')->name('accountsettings');
Route::post('/accountsettingssave', 'HomeController@accountSettingsSave')->name('accountsettingssave');


Route::get('/mindset', 'HomeController@mindset')->name('mindset');


Route::get('auth/facebook', 'Auth\FacebookController@redirectToFacebook');

Route::get('auth/facebook/callback', 'Auth\FacebookController@handleFacebookCallback');


Route::get('/users', 'UserController@users')->name('users');
//Route::delete('/users/delete/{id}', 'UserController@usersDelete')->name('users.delete');
Route::match(array('get', 'post'), '/users/edit/{id}', 'UserController@usersEdit')->name('users.edit');
Route::post('/membersave', 'UserController@memberSave')->name('member.save');
Route::post('/memberupdate', 'UserController@memberUpdate')->name('member.update');
Route::match(array('get', 'post'), '/resetpassword/{id}', 'Auth\LoginController@usersResetPassword')->name('users.resetpassword');
Route::post('/memberpassordreset', 'Auth\LoginController@memberPasswordUpdate')->name('member.passordreset');

Route::match(array('get', 'post'), '/emailverification/{id}', 'Auth\LoginController@usersEmailVerification')->name('users.email.verification');


Route::match(array('get', 'post'), '/role/create', 'RoleController@create')->name('role.create');
Route::post('/rolemodify', 'RoleController@roleModify')->name('role.modify');

Route::match(array('get', 'post'), '/module/create', 'ModuleController@create')->name('module.create');
Route::post('/permissionmodify', 'ModuleController@permissionModify')->name('permission.modify');


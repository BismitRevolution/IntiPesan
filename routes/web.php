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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'PageController@index')->name('index');
Route::get('/home', 'PageController@home')->name('home');
Route::get('/test', 'PageController@test')->name('test');
Route::get('/verify/{id}', 'PageController@verify')->name('verify');
Route::get('/notify', 'PageController@notify')->name('notify');

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
  Route::get('/login', 'AdminAuth\LoginController@showLoginForm')->name('login');
  Route::post('/login', 'AdminAuth\LoginController@login');
  Route::post('/logout', 'AdminAuth\LoginController@logout')->name('logout');

  Route::get('/register', 'AdminAuth\RegisterController@showRegistrationForm')->name('register');
  Route::post('/register', 'AdminAuth\RegisterController@register');

  Route::post('/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
  Route::post('/password/reset', 'AdminAuth\ResetPasswordController@reset')->name('password.email');
  Route::get('/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
  Route::get('/password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');

  Route::resource('/events', 'EventController');
  Route::get('/events/reset/{id}', 'EventController@resetVerification');
  Route::resource('/registrants', 'RegistrantController');
  Route::resource('/notifications', 'NotificationController');
  Route::resource('/articles', 'ArticleController');
});

Route::group(['prefix' => 'registrant', 'as' => 'registrant.'], function () {
  Route::get('/login', 'RegistrantAuth\LoginController@showLoginForm')->name('login');
  Route::post('/login', 'RegistrantAuth\LoginController@login');
  Route::post('/logout', 'RegistrantAuth\LoginController@logout')->name('logout');

  Route::get('/register', 'RegistrantAuth\RegisterController@showRegistrationForm')->name('register');
  Route::post('/register', 'RegistrantAuth\RegisterController@register');

  Route::post('/password/email', 'RegistrantAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
  Route::post('/password/reset', 'RegistrantAuth\ResetPasswordController@reset')->name('password.email');
  Route::get('/password/reset', 'RegistrantAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
  Route::get('/password/reset/{token}', 'RegistrantAuth\ResetPasswordController@showResetForm');
});

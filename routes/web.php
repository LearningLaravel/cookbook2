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

Route::get('login/facebook', 'Auth\AuthController@redirectToFacebook');
Route::get('login/facebook/callback', 'Auth\AuthController@getFacebookCallback');

Route::get('/', 'PagesController@home');
Route::get('/about', 'PagesController@about');
Route::get('/contact', 'PagesController@contact');


Auth::routes();

Route::get('/home', 'PagesController@home');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::post('upload', 'ImagesController@store');
Route::get('/blog', 'BlogController@index');

Route::get('json', function () {
    return App\Post::paginate();
});

Route::get('users/register', 'Auth\AuthController@getRegister');
Route::post('users/register', 'Auth\AuthController@postRegister');

Route::get('users/login', 'Auth\AuthController@getLogin');
Route::post('users/login', 'Auth\AuthController@postLogin');

Route::post('imageupload', 'ImagesController@storeImage');
Route::post('cropimage', 'ImagesController@storeCroppedImage');

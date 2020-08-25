<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'BlogController@index')->name('index');
Route::get('/category/{slug}', 'BlogController@category')->name('blog.category');
Route::get('/post/{post:slug}', 'PostController@show')->name('post.show');
Route::post('/post/comment', 'CommentController@store')->name('post.comment.store');
Route::post('/summernote_upload', 'SummernoteController@store')->name('summernote.upload');
Route::post('/summernote/delete', 'SummernoteController@destroy')->name('summernote.delete');

Auth::routes();

Route::get('/user', 'BlogController@user')->name('blog.user');

Route::group(['prefix' => 'admin'], function() {
    Route::get('/', 'AdminController@index')->name('admin.index');
    Route::get('/', 'AdminController@showLoginForm')->name('admin.login');
    Route::post('/', 'AdminController@login')->name('admin.login');
    Route::post('/', 'AdminController@logout')->name('admin.logout');
    Route::get('/', 'AdminController@index')->name('admin.index');
    Route::resource('/category', 'CategoryController')->except([
		'show',
	]);
	Route::resource('/post', 'PostController');
	Route::resource('/comment', 'CommentController');
});

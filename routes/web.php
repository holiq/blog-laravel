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

Route::get('/', 'BlogController@index')->name('blog.index');
Route::get('/category/{slug}', 'BlogController@category')->name('blog.category');
Route::get('/post/{post:slug}', 'PostController@show')->name('post.show');
Route::post('/post/comment', 'CommentController@store')->name('post.comment.store');
Route::post('/summernote_upload', 'SummernoteController@store')->name('summernote.upload');
Route::post('/summernote/delete', 'SummernoteController@destroy')->name('summernote.delete');

Auth::routes();

Route::get('/user', 'BlogController@user')->name('blog.user');

Route::group(['prefix' => 'admin', 'middleware' => 'guest.admin'], function() {
    Route::get('/login', 'AdminAuthController@showLoginForm')->name('admin.login');
    Route::post('/login', 'AdminAuthController@login')->name('admin.login');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth.admin'], function() {
    Route::get('/', 'AdminController@index')->name('admin.index');
    Route::post('/logout', 'AdminAuthController@logout')->name('admin.logout');
    Route::resource('/category', 'CategoryController')->except([
		'show',
	]);
	Route::resource('/post', 'PostController');
	Route::resource('/summernote', 'SummernoteController')->except([
	    'index', 'create', 'show', 'edit', 'update',
	]);
	Route::resource('/comment', 'CommentController');
	Route::resource('/role', 'RoleController')->except([
	    'create',
	]);
	Route::resource('/permission', 'PermissionController')->except([
	    'create'
	]);
	Route::resource('/users', 'UserController')->except([
	    'show'
	]);
	Route::group(['prefix' => 'users'], function() {
		Route::get('/roles/{id}', 'UserController@roles')->name('users.roles');
		Route::put('/roles/{id}', 'UserController@setRole')->name('users.set_role');
	});
});

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(['register'=>false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::namespace('Admin')->prefix('admin')->middleware('auth')->group(function () {

	//Blog Routes
	// Route::get('blogs/list', 'BlogController@getList')->name('blogs.list');
	// Route::get('blog/add', 'BlogController@add_form')->name('blog.add');
	// Route::post('blog/create', 'BlogController@add_record')->name('blog.create');
	// Route::get('blog/edit/{id}', 'BlogController@edit_form')->name('blog.edit');
	// Route::get('blog/status/update', 'BlogController@change_status')->name('blog.status');
	// Route::post('blog/update', 'BlogController@update_record')->name('blog.update');
	// Route::get('blog/delete/{id}', 'BlogController@del_record')->name('blog.delete');

    Route::get('/album', [App\Http\Controllers\AlbumController::class, 'index'])->name('album.list');
    Route::get('/album/create', [App\Http\Controllers\AlbumController::class, 'create'])->name('album.create');
    Route::post('/album/store', [App\Http\Controllers\AlbumController::class, 'store'])->name('album.store');
    Route::get('/album/edit/{id}', [App\Http\Controllers\AlbumController::class, 'edit'])->name('album.edit');
    Route::post('/album/update/', [App\Http\Controllers\AlbumController::class, 'update'])->name('album.update');
    Route::get('/album/delete/{id}', [App\Http\Controllers\AlbumController::class, 'destroy'])->name('album.delete');


	

});

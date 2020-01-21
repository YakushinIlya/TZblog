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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/profile', 'Profile\ProfileController@index')->middleware('auth')->name('profile');

Route::group(['namespace' => 'Admin', 'middleware' => ['auth', 'role']], function() {
    Route::get('/admin', 'AdminPanelController@index')->name('admin');

    Route::get('/admin/pages', 'AdminPanelPagesController@index')->name('adminPages');

    Route::get('/admin/pages/add', 'AdminPanelPagesController@add')->name('adminPagesAdd');
    Route::post('/admin/page/add', 'Content\PagesController@add')->name('adminPageAdd');

    Route::get('/admin/pages/update/{id}', 'AdminPanelPagesController@update')->name('adminPagesUpdate');
    Route::post('/admin/page/update', 'Content\PagesController@update')->name('adminPageUpdate');

    Route::get('/admin/pages/delete/{id}', 'AdminPanelPagesController@delete')->name('adminPagesDelete');
});

Route::get('/{page}', 'HomeController@index')->name('page');


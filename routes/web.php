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

    Route::get('/admin/category', 'AdminPanelCategoryController@index')->name('adminCategory');
    Route::get('/admin/category/add', 'AdminPanelCategoryController@add')->name('adminCategorysAdd');
    Route::post('/admin/category/add', 'Content\CategoryController@add')->name('adminCategoryAdd');
    Route::get('/admin/category/update/{id}', 'AdminPanelCategoryController@update')->name('adminCategorysUpdate');
    Route::post('/admin/category/update', 'Content\CategoryController@update')->name('adminCategoryUpdate');
    Route::get('/admin/category/delete/{id}', 'AdminPanelCategoryController@delete')->name('adminCategoryDelete');

    Route::get('/admin/posts', 'AdminPanelPostController@index')->name('adminPost');
    Route::get('/admin/posts/add', 'AdminPanelPostController@add')->name('adminPostsAdd');
    Route::post('/admin/post/add', 'Content\PostController@add')->name('adminPostAdd');
    Route::get('/admin/posts/close/{id}', 'AdminPanelPostController@close')->name('adminPostClose');
    Route::get('/admin/posts/open/{id}', 'AdminPanelPostController@open')->name('adminPostOpen');
    Route::get('/admin/posts/update/{id}', 'AdminPanelPostController@update')->name('adminPostsUpdate');
    Route::post('/admin/post/update', 'Content\PostController@update')->name('adminPostUpdate');
    Route::get('/admin/post/delete/{id}', 'AdminPanelPostController@delete')->name('adminPostDelete');
    Route::match(['get', 'post'], '/editor-upload', 'Content\AjaxUpload@editor')->name('EditorUpload');

    Route::get('/admin/comments', 'AdminPanelCommentController@index')->name('adminComment');
    Route::get('/admin/comments/public/{id}', 'AdminPanelCommentController@public')->name('adminCommentPublic');
    Route::get('/admin/comments/public-out/{id}', 'AdminPanelCommentController@publicOut')->name('adminCommentPublicOut');
    Route::get('/admin/comments/delete/{id}', 'AdminPanelCommentController@delete')->name('adminCommentDelete');
});

Route::post('/ajax/likes', 'PostController@likes')->name('likes');
Route::post('/comment/{id}', 'PostController@comment')->where('id', '[0-9]+')->name('commentAdd');

Route::get('/category', 'CategoryController@index')->name('categories');
Route::get('/category/{id}', 'CategoryController@category')->where('id', '[0-9]+')->name('category');
Route::get('/author/{id}', 'AuthorController@index')->where('id', '[0-9]+')->name('author');
Route::get('/post/{id}', 'PostController@index')->where('id', '[0-9]+')->name('post');
Route::get('/{page}', 'PageController@index')->where('page', '[A-Za-z0-9]+')->name('page');

Route::post('/search', 'SearchController@index')->name('search');



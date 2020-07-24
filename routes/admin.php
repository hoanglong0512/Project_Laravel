<?php

use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['web']], function () {
    // index product
Route::get('product', 'ProductController@getAll')->name('admin.product');
// add product
Route::get('add-product', 'ProductController@addProduct')->name('admin.add.product');
Route::post('add-product', 'ProductController@saveProduct');
// xóa product
Route::get('remove-product', 'ProductController@delete')->name('delete.product');
// sửa product
Route::get('edit-product', 'ProductController@edit')->name('edit.product');
Route::put('save-edit-product', 'ProductController@saveEdit')->name('save-edit-product');
// tìm kiếm sản phẩm
Route::get('search/product', 'ProductController@getAll')->name('search.product');

// index danh mục
Route::get('categories', 'CategoryController@getAll')->name('admin.category');
// add danh mục
Route::get('add-category', 'CategoryController@addForm')->name('add-category');
Route::post('add-category', 'CategoryController@saveForm');
// sửa danh mục
Route::get('edit-category/{id}', 'CategoryController@edit')->name('edit-cate');
Route::post('edit-category/{id}', 'CategoryController@saveEdit');
// tìm kiếm danh mục
Route::get('search-cate', 'CategoryController@search')->name('search-cate');
// xóa danh mục
Route::get('remove-cate','CategoryController@remove')->name('cate.remove');

// index bài viết
Route::get('posts', 'PostsController@index')->name('index.posts');
// add bài viết
Route::get('add/posts', 'PostsController@addForm')->name('add.posts');
Route::post('add/posts', 'PostsController@saveForm');
// sửa bài viết
Route::get('edit/posts/{id}', 'PostsController@edit')->name('edit.posts');
Route::post('edit/posts/{id}', 'PostsController@saveEdit');

// xóa bài  viết
Route::get('remove/posts', 'PostsController@remove')->name('remove.posts');

// search bài viết 
Route::get('search', 'PostsController@search')->name('search-posts');

// search trang chủ 
Route::get('search/index', 'HomeController@search')->name('search-index');

});



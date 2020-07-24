<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
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
    return redirect()->route('home');
});
Auth::routes();


// Route::get('/index', function(){
//     return view('index');
// });

Route::get('/home', 'HomeController@home')->name('home');

Route::get('/detail', 'ProductController@detailProduct')->name('detail');

Route::get('/blog-details', 'HomeController@blogDetail')->name('blog.details');

Route::get('/blog', 'HomeController@blog')->name('blog');

Route::get('/check-out', 'HomeController@checkOut')->name('check.out');

Route::post('/check-out', 'HomeController@saveInvoices')->name('save_Invoices');

Route::get('/contact', 'HomeController@contact')->name('contact');



Route::get('/main', 'HomeController@main')->name('main');

Route::get('/shop-grid', 'ProductController@shopGrid')->name('shop.grid');

Route::get('/shop-cates', 'CategoryController@shopGrid')->name('shop.cates');

Route::get('shoping-cart', 'CartController@shopCart')->name('shoping.cart');

Route::get('logout', 'HomeController@logout')->name('logout');

Route::group(['prefix' => 'cart'], function () {
    Route::get('add/{id}', 'CartController@addToCart')->name('cart');
    Route::get('remove', 'CartController@remove')->name('cart.delete');
    Route::get('update', 'CartController@update')->name('update.cart');
});

Route::get('search/index', 'HomeController@search')->name('search-index');








Route::get('get', function () {
    $cookie = Illuminate\Support\Facades\Cookie::get('cartId');
    $cart = json_decode($cookie, true);
    echo "<pre>";
    print_r($cart);
});

Route::get('test-home', function () {
    return view('client.home-page');
});

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

Route::group(['middleware' => ['auth']], function () {
    Route::get('/cart', 'CartController@index')->name('cart');
    Route::delete('/cart/{id}', 'CartController@delete')->name('cart-delete');
    Route::post('/checkout', 'CheckoutController@prosess')->name('checkout');
    //dashboard
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');


    Route::get('/dashboard/products', 'DashboardProductController@index')->name('dashboard-products');
    Route::get('/dashboard/products/create', 'DashboardProductController@create')->name('dashboard-products-create');
    Route::post('/dashboard/products', 'DashboardProductController@store')->name('dashboard-product-store');
    Route::get('/dashboard/products/{id}', 'DashboardProductController@details')->name('dashboard-products-detail');
    Route::put('/dashboard/products/{id}', 'DashboardProductController@update')->name('dashboard-product-update');
    Route::post('/dashboard/products/gallery/upload', 'DashboardProductController@uploadGallery')->name('dashboard-product-gallery-upload');
    Route::delete('/dashboard/products/gallery/delete/{id}', 'DashboardProductController@deleteGallery')->name('dashboard-product-gallery-delete');


    Route::get('/dashboard/transactions', 'DashboardTransactionController@index')->name('dashboard-transaction');
    Route::get('/dashboard/transactions/{id}', 'DashboardTransactionController@details')->name('dashboard-transactions-detail');
    Route::post('/dashboard/transactions/{id}', 'DashboardTransactionController@update')->name('dashboard-transactions-update');

    Route::get('/dashboard/settings', 'DashboardSettingController@store')->name('dashboard-setting');
    Route::get('/dashboard/account', 'DashboardSettingController@account')->name('dashboard-setting-account');
    Route::post('/dashboard/update/{redirect}', 'DashboardSettingController@update')
        ->name('dashboard-settings-redirect');
});

Route::get('/', 'HomeController@index')->name('home');
Route::get('/success', 'HomeController@success')->name('success');

Route::get('/category', 'CategoryController@index')->name('category');
Route::get('/category/{id}', 'CategoryController@detail')->name('category-detail');

Route::get('/detail/{id}', 'DetailController@index')->name('detail');
Route::post('/detail/{id}', 'DetailController@add')->name('detail-add');


Route::get('/checkout/callback', 'CheckoutController@callback')->name('midtrans-callback');

Route::get('/register/success', 'Auth\RegisterController@success')->name('register-success');



//admin
// 
Route::prefix('admin')->namespace('Admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', 'DashboardController@index')->name('admin-dashboard');
    Route::resource('category', 'CategoryController');
    Route::resource('user', 'UserController');
    Route::resource('product', 'ProductController');
    Route::resource('product-gallery', 'ProductGalleryController');
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

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



Route::view('/', 'home');
Route::get('contact-us', 'ContactUsController@show');
Route::post('contact-us', 'ContactUsController@sendEmail');

Route::get('shop', 'ShopController@index');
Route::get('shop/{id}', 'ShopController@show');
Route::get('shop_alt', 'ShopController@shop_alt');


Route::get('basket/dropdown', 'BasketController@dropdown');
Route::get('basket/addToCard', 'BasketController@addToCard');
Route::resource('basket', 'BasketController');



Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::redirect('/', 'records');
    Route::get('genres/qryGenres', 'Admin\GenreController@qryGenres');
    Route::resource('genres', 'Admin\GenreController');
    Route::resource('records', 'Admin\RecordController');
    Route::resource('users', 'Admin\UserController');
    Route::resource('users2', 'Admin\User2Controller', ['parameters' => ['users2' => 'user']]);

    Route::get('users3/fetchdata', 'Admin\User3Controller@fetchdata');
    Route::get('users3/get_datatable', 'Admin\User3Controller@get_datatable');
    Route::resource('users3', 'Admin\User3Controller', ['parameters' => ['users3' => 'user']]);



    Route::get('orders/get_orderlines', 'Admin\OrdersController@get_orderlines');
    Route::get('orders/get_orders', 'Admin\OrdersController@get_orders');
    Route::resource('orders', 'Admin\OrdersController');



    Route::get('dashboard/getUsersFunctionCount', 'Admin\DashboardController@getUsersFunctionCount');
    Route::get('dashboard/getOrders', 'Admin\DashboardController@getOrders');
    Route::resource('dashboard', 'Admin\DashboardController');





});


Route::redirect('user', '/user/profile');
Route::middleware(['auth'])->prefix('user')->group(function () {
    Route::get('profile', 'User\ProfileController@edit');
    Route::post('profile', 'User\ProfileController@update');
    Route::get('password', 'User\PasswordController@edit');
    Route::post('password', 'User\PasswordController@update');




    Route::get('history/get_orderlines', 'User\OrderHistoryController@get_orderlines');
    Route::get('history/get_orders', 'User\OrderHistoryController@get_orders');
    Route::resource('history', 'User\OrderHistoryController');




});



Auth::routes();
Route::view('/', 'home');
Route::get('logout', 'Auth\LoginController@logout');
//Route::get('/home', 'HomeController@index')->name('home');

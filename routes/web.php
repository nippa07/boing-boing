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
    return redirect('login');
});

Auth::routes();

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
|
| Here is the Public routes
|
*/
Route::prefix('/')->namespace('PublicArea')->group(function () {

    Route::get('/custom/offer', 'HomeController@customOffer')->name('public.custom.offer');
    Route::post('/custom/offer', 'HomeController@storeCustomOffer')->name('public.store.custom.offer');

    Route::get('/quote/accept/{id}', 'QuoteController@quoteAccept')->name('public.quote.accept');
    Route::get('/quote/decline/{id}', 'QuoteController@quoteDecline')->name('public.quote.decline');

    Route::get('/thank-you', 'QuoteController@thankYou')->name('public.quote.thankYou');
    Route::get('/checkout/{id?}', 'QuoteController@checkout')->name('public.quote.checkout');
    Route::post('/checkout', 'QuoteController@saveCheckout')->name('public.quote.checkout.save');

    Route::get('/receipt/{id}', 'QuoteController@receipt')->name('public.order.receipt');

    Route::get('/paypal/success/{id}', 'QuoteController@paypalSuccess')->name('public.paypal.success');
    Route::get('/paypal/cancel/{id}', 'QuoteController@paypalCancel')->name('public.paypal.cancel');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is the Admin routes
|
*/
Route::prefix('/admin')->namespace('AdminArea')->group(function () {

    Route::get('/', 'HomeController@index')->name('admin.index');
    Route::get('/', 'HomeController@index')->name('admin.index');

    Route::prefix('/custom/offer')->group(function () {
        Route::get('/', 'CustomOfferController@all')->name('admin.custom.offer.all');
        Route::get('/view/{id}', 'CustomOfferController@view')->name('admin.custom.offer.view');
        Route::get('/delete/{id}', 'CustomOfferController@delete')->name('admin.custom.offer.delete');
    });

    Route::prefix('/offer/quote')->group(function () {
        Route::get('/', 'QuoteController@all')->name('admin.offer.quote.all');
        Route::get('/add/{id?}', 'QuoteController@add')->name('admin.offer.quote.add');
        Route::post('/store', 'QuoteController@store')->name('admin.offer.quote.store');
        Route::get('/edit/{id}', 'QuoteController@edit')->name('admin.offer.quote.edit');
        Route::get('/view/{id}', 'QuoteController@view')->name('admin.offer.quote.view');
        Route::post('/update/{id}', 'QuoteController@update')->name('admin.offer.quote.update');
        Route::get('/delete/{id}', 'QuoteController@delete')->name('admin.offer.quote.delete');
    });

    Route::prefix('/orders')->group(function () {
        Route::get('/', 'OrderController@all')->name('admin.orders.all');
        Route::get('/add/{id?}', 'OrderController@add')->name('admin.orders.add');
        Route::post('/store', 'OrderController@store')->name('admin.orders.store');
        Route::get('/edit/{id}', 'OrderController@edit')->name('admin.orders.edit');
        Route::get('/view/{id}', 'OrderController@view')->name('admin.orders.view');
        Route::post('/update/{id}', 'OrderController@update')->name('admin.orders.update');
        Route::get('/delete/{id}', 'OrderController@delete')->name('admin.orders.delete');

        Route::get('/complete/{id}', 'OrderController@complete')->name('admin.orders.complete');
        Route::get('/in_production/{id}', 'OrderController@inProduction')->name('admin.orders.in_production');
    });
});

/*
|--------------------------------------------------------------------------
| Customer Routes
|--------------------------------------------------------------------------
|
| Here is the Customer routes
|
*/
Route::prefix('/customer')->namespace('CustomerArea')->group(function () {

    Route::get('/', 'HomeController@index')->name('customer.index');

    Route::prefix('/orders')->group(function () {
        Route::get('/', 'OrderController@all')->name('customer.orders.all');
        Route::get('/add/{id?}', 'OrderController@add')->name('customer.orders.add');
        Route::post('/store', 'OrderController@store')->name('customer.orders.store');
        Route::get('/edit/{id}', 'OrderController@edit')->name('customer.orders.edit');
        Route::get('/view/{id}', 'OrderController@view')->name('customer.orders.view');
        Route::post('/update/{id}', 'OrderController@update')->name('customer.orders.update');
        Route::get('/delete/{id}', 'OrderController@delete')->name('customer.orders.delete');
    });
});

/*
|--------------------------------------------------------------------------
| Common Routes
|--------------------------------------------------------------------------
|
| Here is the Common routes
|
*/
Route::get('/get/states', 'CommonController@getStates')->name('get.states');
Route::get('/mailTest', 'CommonController@mailTest')->name('mailTest');

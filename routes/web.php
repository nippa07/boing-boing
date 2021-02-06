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

    Route::get('/quote/accept/{id}', 'HomeController@quoteAccept')->name('public.quote.accept');
    Route::get('/quote/decline/{id}', 'HomeController@quoteDecline')->name('public.quote.decline');
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
        Route::get('/add', 'QuoteController@add')->name('admin.offer.quote.add');
        Route::post('/store', 'QuoteController@store')->name('admin.offer.quote.store');
        Route::get('/edit/{id}', 'QuoteController@edit')->name('admin.offer.quote.edit');
        Route::get('/view/{id}', 'QuoteController@view')->name('admin.offer.quote.view');
        Route::post('/update/{id}', 'QuoteController@update')->name('admin.offer.quote.update');
        Route::get('/delete/{id}', 'QuoteController@delete')->name('admin.offer.quote.delete');
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

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
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

//Route::resource('transactions', 'TransactionController');

Route::group(['middleware' => 'auth:web', 'prefix' => 'clients'], function () {
//    Route::resource('clients', 'ClientController');
    Route::get('/',         ['as' => 'clients.index',    'uses' => 'ClientController@index']);

    Route::get('/create',     ['as' => 'clients.create',     'uses' => 'ClientController@create']);
    Route::post('/',     ['as' => 'clients.store',    'uses' => 'ClientController@store']);

    Route::get('/{id}/edit',   ['as' => 'clients.edit',    'uses' => 'ClientController@edit']);
    Route::patch('/{client}',  ['as' => 'clients.update',    'uses' => 'ClientController@update']);
    Route::delete('/{id}', ['as' => 'clients.destroy',    'uses' => 'ClientController@destroy']);
});

Route::group(['middleware' => 'auth:web', 'prefix' => 'transactions'], function () {
    Route::get('/',         ['as' => 'transactions.index',    'uses' => 'TransactionController@index']);

    Route::get('/create',     ['as' => 'transactions.create',     'uses' => 'TransactionController@create']);
    Route::post('/',     ['as' => 'transactions.store',    'uses' => 'TransactionController@store']);

    Route::get('/{transaction}/edit',   ['as' => 'transactions.edit',    'uses' => 'TransactionController@edit']);
    Route::patch('/{transaction}',  ['as' => 'transactions.update',    'uses' => 'TransactionController@update']);
    Route::delete('/{transaction}', ['as' => 'transactions.destroy',    'uses' => 'TransactionController@destroy']);

    // display transactions by Client
    Route::get('/client/{client_id}', ['as' => 'transactions.index',    'uses' => 'TransactionController@listByClient']);

    //display Client list
    Route::get('query', 'AutoCompleteSearchClientController@index');
    Route::get('autocomplete', 'AutoCompleteSearchClientController@autocomplete');
});

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

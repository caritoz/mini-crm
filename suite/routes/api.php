<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'auth'], function () {

    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');

    Route::group(['middleware' => 'auth:api'], function() {

        // Login Auth
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');

        // Clients CRUD
        Route::group(['prefix' => 'clients'], function () {
            Route::get('/', 'ClientController@index');
            Route::post('/',    'ClientController@store');
            Route::get('/{id}/edit',  'ClientController@edit');
            Route::post('/{client}',  'ClientController@update');
            Route::delete('/{client}','ClientController@destroy');
        });

//        // Transactions CRUD
        Route::group(['prefix' => 'transactions'], function () {
            Route::get('/', 'TransactionController@index');
            Route::post('/', 'TransactionController@store');
            Route::delete('/{transaction}','TransactionController@destroy');
        });

        //display Client list
        Route::get('search', 'AutoCompleteSearchClientController@autocomplete');
    });
});

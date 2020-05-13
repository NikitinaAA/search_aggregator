<?php

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
Route::group([
    'namespace' => 'Api',
    'middleware' => ['api']
], function () {
    Route::group([
        'middleware' => ['client.access']
    ], function (){
        Route::get('/search/{token}', 'SearchController@search');
        Route::get('/search/{token}/get_types', 'SearchController@getTypes');
    });
});


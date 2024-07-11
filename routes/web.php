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

//JUST ADD '->defaults("group", "Settings")' IF YOU WANT TO GROUP A NAV IN A DROPDOWN

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', function(){
   echo "???";
});

Route::get('/test', 'TestController@test');

// API
Route::group([
        'prefix' => "api/"
    ], function (){
        // AUTH
        Route::post('/tokens/create', 'ApiController@getToken');
        Route::get('/unauthenticated', 'ApiController@unauthenticated')->name('unauthenticated');
        Route::middleware('auth:sanctum')->post('/tokens/revoke', 'ApiController@revokeToken');

        // USERS
        Route::middleware('auth:sanctum')->get('/users/get', 'UserController@getUser');
        Route::middleware('auth:sanctum')->post('/users/create', 'UserController@createUser');
        Route::middleware('auth:sanctum')->post('/users/update', 'UserController@updateUser');
        Route::middleware('auth:sanctum')->post('/users/delete', 'UserController@deleteUser');
    }
);

// require __DIR__.'/auth.php';
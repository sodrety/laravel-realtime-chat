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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', [App\Http\Controllers\UserController::class, 'login']);
Route::post('register', [App\Http\Controllers\UserController::class, 'register']);


Route::group(['middleware' => 'auth:api'], function(){

	Route::post('details', [App\Http\Controllers\UserController::class, 'details']);
    Route::get('messages', [App\Http\Controllers\ChatController::class, 'fetchAllMessages'])->name('messages');
    Route::post('messages', [App\Http\Controllers\ChatController::class, 'sendMessage'])->name('messages');

});

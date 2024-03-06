<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/sanctum/logout', function (Request $request) {
    $request->user()->currentAccessToken()->delete();

    return response()->json(['message' => 'Token deleted']);
});

Route::namespace('App\Api\User\Controllers')->group(function () {
    Route::post('/users', 'UserController@store');
    Route::post('/users/token', 'LoginController@login');
    Route::get('/sanctum/csrf-cookie', 'LoginController@csrfToken');
});

Route::namespace('App\Api\Deposit\Controllers')->middleware('auth:sanctum')->group(function () {
    Route::post('/deposits', 'DepositController@store');
    Route::get('/deposits/pending', 'DepositController@getPending');
    Route::get('/deposits/customer', 'DepositController@getByCustomer');
    Route::patch('/deposits/{id}', 'DepositController@updateStatus');
    Route::get('/deposits/total', 'DepositController@getTotal');
});

Route::namespace('App\Api\Expense\Controllers')->middleware('auth:sanctum')->group(function () {
    Route::post('/expenses', 'ExpenseController@store');
    Route::get('/expenses/total', 'ExpenseController@getTotal');
});

Route::namespace('App\Api\Movement\Controllers')->middleware('auth:sanctum')->group(function () {
    Route::get('/movements', 'MovementController@get');
});

Route::namespace('App\Api\Balance\Controllers')->middleware('auth:sanctum')->group(function () {
    Route::get('/balance', 'CurrentBalanceController@index');
});

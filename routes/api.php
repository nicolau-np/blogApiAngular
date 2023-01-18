<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\UserController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('noticias')->group(function () {
    Route::get('/', [NoticiaController::class, 'index']);
    Route::get('/{id}', [NoticiaController::class, 'show']);
    Route::post('/', [NoticiaController::class, 'store']);
    Route::put('/{id}', [NoticiaController::class, 'update']);
    Route::delete('/{id}', [NoticiaController::class, 'destroy']);
});

Route::prefix('user')->group(function () {
    Route::post('login', [UserController::class, 'login']);
    Route::post('logout', [UserController::class, 'logout']);
});
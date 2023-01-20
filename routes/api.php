<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\UserController;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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

/*Route::get('all', function () {
    return UserResource::collection(User::all());
});
*/

Route::prefix('noticias')->group(function () {
    Route::get('/', [NoticiaController::class, 'index']);
    Route::get('/{id}', [NoticiaController::class, 'show']);
    Route::post('/', [NoticiaController::class, 'store']);
    Route::put('/{id}', [NoticiaController::class, 'update']);
    Route::delete('/{id}', [NoticiaController::class, 'destroy']);
});

Route::prefix('auth')->group(function () {
    // Route::get('/{id}', [UserController::class, 'index']);
    Route::post('register', [UserController::class, 'register']);
    Route::post('login', [UserController::class, 'login']);
    Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
});
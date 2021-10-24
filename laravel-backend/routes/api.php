<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;

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

// post

Route::apiResource('posts', PostController::class)->only([
   'store', 'update', 'destroy'
])->middleware(['auth:api']);

Route::apiResource('posts', PostController::class)->except([
   'store', 'update', 'destroy'
]);

Route::group([
   'middleware' => ['api', 'auth:api'],
   'prefix' => 'auth'
], function ($router) {

   Route::post('register', [AuthController::class, 'register'])->withoutMiddleware(['auth:api']);
   Route::post('login', [AuthController::class, 'login'])->withoutMiddleware(['auth:api']);
   Route::post('logout', [AuthController::class, 'logout']);
   Route::post('refresh', [AuthController::class, 'refresh'])->withoutMiddleware(['auth:api']);
   Route::get('user', [AuthController::class, 'user']);
});


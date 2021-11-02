<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthApiController;
use App\Http\Controllers\RoleApiController;
use App\Http\Controllers\UserApiController;

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

// ================================================================================================
// Authentication Controller
// ================================================================================================
Route::post(
    '/auth/login',
    [AuthApiController::class, 'login']
)->middleware('throttle:5');

Route::middleware(['auth:sanctum'])->group(function () {
    // ================================================================================================
    // Authentication Controller
    // ================================================================================================
    Route::post(
        '/auth/logout',
        [AuthApiController::class, 'logout']
    );
    Route::get(
        '/auth/get-auth',
        [AuthApiController::class, 'getAuth']
    );

    Route::middleware(['admin'])->group(function () {
        // ================================================================================================
        // Role Controller
        // ================================================================================================
        Route::post(
            '/role/store',
            [RoleApiController::class, 'store']
        );
        Route::get(
            '/role/get',
            [RoleApiController::class, 'get']
        );
        Route::post(
            '/role/update/{role}',
            [RoleApiController::class, 'update']
        );
        Route::delete(
            '/role/delete/{role}',
            [RoleApiController::class, 'delete']
        );

        // ================================================================================================
        // User Controller
        // ================================================================================================
        Route::post(
            '/user/store',
            [UserApiController::class, 'store']
        );
        Route::get(
            '/user/get',
            [UserApiController::class, 'get']
        );
        Route::post(
            '/user/update/{user}',
            [UserApiController::class, 'update']
        );
        Route::delete(
            '/user/delete/{user}',
            [UserApiController::class, 'delete']
        );
    });
});

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthApiController;
use App\Http\Controllers\RoleApiController;
use App\Http\Controllers\UserApiController;
use App\Http\Controllers\ExpenseCategoryApiController;
use App\Http\Controllers\ExpenseApiController;
use App\Http\Controllers\DashboardApiController;

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

    Route::middleware(['auth.role'])->group(function () {
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
        Route::get(
            '/role/get-role-function',
            [RoleApiController::class, 'getRoleFunction']
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

        // ================================================================================================
        // Expense Category Controller
        // ================================================================================================
        Route::post(
            '/expense-category/store',
            [ExpenseCategoryApiController::class, 'store']
        );
        Route::get(
            '/expense-category/get',
            [ExpenseCategoryApiController::class, 'get']
        );
        Route::post(
            '/expense-category/update/{expense_category}',
            [ExpenseCategoryApiController::class, 'update']
        );
        Route::delete(
            '/expense-category/delete/{expense_category}',
            [ExpenseCategoryApiController::class, 'delete']
        );

        // ================================================================================================
        // Expense Controller
        // ================================================================================================
        Route::post(
            '/expense/store',
            [ExpenseApiController::class, 'store']
        );
        Route::get(
            '/expense/get',
            [ExpenseApiController::class, 'get']
        );
        Route::post(
            '/expense/update/{expense}',
            [ExpenseApiController::class, 'update']
        );
        Route::delete(
            '/expense/delete/{expense}',
            [ExpenseApiController::class, 'delete']
        );
    });

    // ================================================================================================
    // Dashboard Controller
    // ================================================================================================
    Route::get(
        '/dashboard/get-category-chart-data',
        [DashboardApiController::class, 'getCategoryChart']
    );
    Route::get(
        '/dashboard/get-periodical-chart-data',
        [DashboardApiController::class, 'getPeriodicalChart']
    );

    Route::get(
        '/role/get-auth-role-function',
        [RoleApiController::class, 'getAuthRoleFunction']
    );
});

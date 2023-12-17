<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiTodoController;
use App\Http\Controllers\ApiCategoryController;
use App\Http\Controllers\AuthController;

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

Route::get('/todos', [ApiTodoController::class, 'getAll'])->middleware('auth:sanctum');
Route::post('/todos', [ApiTodoController::class, 'create'])->middleware('auth:sanctum');
Route::put('/todos/{id}', [ApiTodoController::class, 'updateById'])->middleware('auth:sanctum');
Route::delete('/todos/{id}', [ApiTodoController::class, 'deleteById'])->middleware('auth:sanctum');
Route::get('/todos/{id}', [ApiTodoController::class, 'getById'])->middleware('auth:sanctum');
Route::put('/todos/{id}/status', [ApiTodoController::class, 'updateStatus'])->middleware('auth:sanctum');

Route::get('/categories', [ApiCategoryController::class, 'getAll'])->middleware('auth:sanctum');
Route::post('/categories', [ApiCategoryController::class, 'create'])->middleware('auth:sanctum');
Route::put('/categories/{id}', [ApiCategoryController::class, 'updateById'])->middleware('auth:sanctum');
Route::delete('/categories/{id}', [ApiCategoryController::class, 'deleteById'])->middleware('auth:sanctum');
Route::get('/categories/{id}', [ApiCategoryController::class, 'getById'])->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');
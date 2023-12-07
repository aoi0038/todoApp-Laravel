<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiTodoController;

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

Route::get('/todos', [ApiTodoController::class, 'getAll']);
Route::post('/todos', [ApiTodoController::class, 'create']);
Route::put('/todos/{id}', [ApiTodoController::class, 'updateById']);
Route::delete('/todos/{id}', [ApiTodoController::class, 'deleteById']);
Route::get('/todos/{id}', [ApiTodoController::class, 'getAll']);
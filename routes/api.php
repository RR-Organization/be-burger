<?php

use App\Http\Controllers\API\MenuController;
use App\Http\Controllers\API\PageController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/page', [PageController::class, 'getAllData']);
Route::post('/page/create', [PageController::class, 'createData']);
Route::post('/page/update/{id}', [PageController::class, 'updateData']);

Route::get('/menu', [MenuController::class, 'getAllData']);
Route::post('/menu/create', [MenuController::class, 'createData']);

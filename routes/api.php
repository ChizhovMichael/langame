<?php

use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\RubricController;
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

Route::apiResource('rubrics', RubricController::class)->only([
    'index'
]);

Route::apiResource('posts', PostController::class)->only([
    'index', 'store'
]);

Route::post('search', [
    PostController::class, 'search'
]);

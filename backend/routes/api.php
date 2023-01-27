<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\RegisterController;
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

# Auth Routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']);

# General Routes
Route::middleware('access.token')->group(function () {
    Route::get('/blogs', [BlogController::class, 'index']);
    Route::post('/blog', [BlogController::class, 'create']);
    Route::get('/logout', [AuthController::class, 'logout']);
});

# Admin Routes
Route::middleware(['access.token', 'admin'])->group(function () {
    Route::get('/moderation/blogs', [BlogController::class, 'getModerationBlogs']);
    Route::patch('/approve/blog/{blog}', [BlogController::class, 'approveBlog']);
});

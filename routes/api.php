<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\PostController;

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


Route::get('login', [LoginController::class, 'login'])->name('login');
Route::middleware('auth:sanctum')->group(function () {
    Route::get('posts', [PostController::class, 'index'])->name('posts.index');

    Route::post('posts', [PostController::class, 'store'])->name('posts.store');

    Route::get('posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');

    Route::put('posts/{post}', [PostController::class, 'update'])->name('posts.update');

    Route::delete('posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
});

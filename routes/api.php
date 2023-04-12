<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Broadcast;
use App\Http\Controllers\API\AuthenticationController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\PostController;
use App\Http\Resources\commentResource;
use App\Http\Resources\postResource;
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

Route::post('/login', [AuthenticationController::class, 'loginUser']);

Route::get('/comments', function () {
    return commentResource::collection(\App\Models\comment::all());
})->middleware('auth:sanctum');

Route::get('/comments/{id}', function ($id) {
    return new commentResource(\App\Models\comment::findOrFail($id));
})->middleware('auth:sanctum');

Route::get('/posts', function () {
    return postResource ::collection(\App\Models\post::all());
})->middleware('auth:sanctum');

Route::get('/posts/{id}', function ($id) {
    return new postResource(\App\Models\post::findOrFail($id));
})->middleware('auth:sanctum');

// crud
Route::POST('/posts/create', [PostController::class, 'registerPost'])->middleware('auth:sanctum');

Route::POST('/posts/update/{id}', [PostController::class, 'updatePost'])->middleware('auth:sanctum');

Route::DELETE('/posts/delete/{id}', [PostController::class, 'deletePost'])->middleware('auth:sanctum');

Route::POST('/comments/create/{id}', [CommentController::class, 'submitComment'])->middleware('auth:sanctum');

Route::POST('/comments/update/{id}', [CommentController::class, 'updateComment'])->middleware('auth:sanctum');

Route::DELETE('/comments/delete/{id}', [CommentController::class, 'deleteComment'])->middleware('auth:sanctum');

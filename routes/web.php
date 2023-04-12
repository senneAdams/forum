<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\PostController;
use Illuminate\Auth\Middleware\Authenticate;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// get views
Route::get('/', function () {
    return ViewController::returnView('Login');
});

Route::GET('/viewLogin', function () {
    return ViewController::returnView('Login');
})->name('viewLogin');

Route::GET('/viewRegister', function () {
    return ViewController::returnView('Register');
})->name('viewRegister');

Route::GET('/viewPostIndex', [PostController::class, 'returnPostIndexView'])->name('viewPostIndex');

Route::GET('/viewEditProfile', [UserController::class, 'returnProfileView'])->name('viewEditProfile')->middleware('auth');

Route::GET('/viewCreatePost', function () {
    return ViewController::returnView('createPost');
})->name('viewCreatePost')->middleware('auth');

Route::GET('/viewPost/{id}', function ($id) {
    return PostController::returnPostView($id);
})->name('viewPost');

Route::GET('/EditPost/{id}', function ($id) {
    return PostController::returnPostEditView($id);
})->name('viewEditPost')->middleware('auth');

Route::GET('/viewGetKey', function () {
    return ViewController::returnView('getKey');
})->name('viewGetKey')->middleware('auth');
//

// authenticatie & registreren
Route::POST('/submitRegister', [RegisterController::class, 'registerUser'])->name('submitRegister');

Route::POST('/submitLogin', [AuthenticationController::class, 'login'])->name('submitLogin');

Route::GET('/logOut', [AuthenticationController::class, 'logOut'])->name('logOut');
//

// posts & comments
Route::POST('/submitPost', [PostController::class, 'registerPost'])->name('submitPost');

Route::POST('/submitComment/{postID}', [CommentController::class, 'submitComment'])->name('submitComment');

Route::POST('/submitEditPost/{postID}', [PostController::class, 'updatePost'])->name('submitEditPost');
//

// API Key ophalen
Route::GET('getApiKey',[UserController::class,'getApiKey'])->name('getApiKey')->middleware('auth');
//

// profiel bewerken
Route::POST('/submitEditProfile', [UserController::class, 'submitEditProfile'])->name('submitEditProfile');

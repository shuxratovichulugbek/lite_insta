<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/logout', 'Api\AuthController@logout')->middleware('auth:api');


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
});

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    Route::apiResource('/users', UserController::class);
    Route::get('/users/{user}/images', [UserController::class, 'images']);

    Route::apiResource('/images', ImageController::class);
    Route::get('/images/{image}/comments', [ImageController::class, 'comments']);
    Route::post('/images/{image}/like', [ImageController::class, 'like']);
    Route::delete('/images/{image}/like', [ImageController::class, 'unlike']);

    Route::post('/follows/{user}', [FollowController::class, 'follow']);
    Route::post('/follower', [FollowController::class, 'index']);
    Route::delete('/follows/{user}', [FollowController::class, 'unfollow']);
    Route::get('/followers', [FollowController::class, 'followers']);
    Route::get('/following', [FollowController::class, 'following']);

    Route::apiResource('/comments', CommentController::class)->except('show');
    Route::put('/comments/{comment}', [CommentController::class, 'update']);
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy']);




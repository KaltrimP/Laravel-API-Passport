<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Broadcast;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\PostController;
use App\Http\Controllers\api\UserController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/users', [UserController::class, 'showUsers']);
Route::get('/users/{id}', [UserController::class, 'showSingleUser']);
Route::delete('/users/{id}/delete', [UserController::class, 'deleteUser']);

// Post Routes
// Route::get('/posts/search/{name}', [PostController::class, 'searchPosts']);
// Route::get('/posts/{id}', [PostController::class, 'showSinglePost']);

// Route::post('/posts/create', [PostController::class, 'store']);
// Route::put('/posts/update/{id}', [PostController::class, 'update']);
// Route::delete('/posts/delete/{id}', [PostController::class, 'delete']);
// Route::get('/posts', [PostController::class, 'showPosts'])->middleware('auth:sanctum');



// Route::post('/auth/login', [AuthController::class, 'login']);
// Route::post('/auth/register', [AuthController::class, 'register']);

// Route::post('/tokens/create', function (Request $request) {
//     $token = $request->user()->createToken($request->token_name);

//     return ['token' => $token->plainTextToken];
// });

Broadcast::controller(['middleware'=>['auth:api']],AuthController::class)->group(function(){
    // Route::get('/posts', [PostController::class, 'showPosts'])->middleware('auth:sanctum');
    Route::post('/auth/login', 'login');
    Route::post('/auth/register',  'register');
    Route::post('/auth/logout', 'logout');

    // Route::get('/posts/search/{name}', [PostController::class, 'searchPosts']);
    // Route::get('/posts/{id}', [PostController::class, 'showSinglePost']);

    // Route::post('/posts/create', [PostController::class, 'store']);
    // Route::put('/posts/update/{id}', [PostController::class, 'update']);
    // Route::delete('/posts/delete/{id}', [PostController::class, 'delete']);
});
Route::middleware('auth:api')->get('/posts', [PostController::class, 'showPosts']);



<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\ArtController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\UserController;
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

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::get('/artists', [ArtistController::class, 'index']);
Route::get('/artists/{id}', [ArtistController::class, 'show']);
Route::get('/art', [ArtController::class, 'index']);
Route::get('/art/{id}', [ArtController::class, 'show']);
Route::get('/forms', [FormController::class, 'index']);
Route::get('/forms/{id}', [FormController::class, 'show']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function (Request $request) {
        return auth()->user();
    });

    Route::resource('art', ArtController::class)
        ->only(['store', 'update', 'destroy']);
    Route::resource('artists', ArtistController::class)
        ->only(['store', 'update', 'destroy']);
    Route::resource('forms', FormController::class)
        ->only(['store', 'update', 'destroy']);

    Route::post('/logout', [AuthController::class, 'logout']);
});

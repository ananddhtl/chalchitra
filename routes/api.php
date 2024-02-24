<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicUsersController;
use App\Http\Controllers\MovieController;

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

// Route::post('/adduserData', [PublicUsersController::class, 'store']);
// Route::POST('/userLogin', [PublicUsersController::class, 'login']);

Route::group(['prefix' => 'auth'], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware('api')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
    });
});


Route::get('/gethomepage', [MovieController::class, 'gethomepage']);
Route::get('/getmoviedescription/{id}', [MovieController::class, 'getmoviedescription']);

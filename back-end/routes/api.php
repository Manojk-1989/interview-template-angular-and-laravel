<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserFormulaCalculatorController;
use App\Http\Controllers\Api\AdminFormulaCalculatorController;



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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


// Route::group(['middleware' => ['jwt.verify']], function() {
//     Route::get('/get-all-users', [AdminFormulaCalculatorController::class, 'getAllUsers']);

//     Route::post('/logout', [AuthController::class, 'logout']);
//     Route::get('/get-user', [UserController::class, 'getUser']);
//     Route::post('/calculate-without-step', [UserFormulaCalculatorController::class, 'calculateWithoutStep']);
//     Route::post('/calculate-with-step', [AdminFormulaCalculatorController::class, 'calculateWithStep']);



    

// });

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::group(['prefix' => 'admin','middleware' => ['admin']], function() {
        Route::get('/get-all-users', [AdminFormulaCalculatorController::class, 'getAllUsers']);
        Route::post('/calculate-with-step', [AdminFormulaCalculatorController::class, 'calculateWithStep']);
    });

    Route::group(['prefix' => 'user','middleware' => ['user']], function() {
        Route::get('/get-user', [UserController::class, 'getUser']);
        Route::post('/calculate-without-step', [UserFormulaCalculatorController::class, 'calculateWithoutStep']);
    });
});




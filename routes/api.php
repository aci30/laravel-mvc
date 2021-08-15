<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\UserController;

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

Route::prefix('v1')->name('api.')->group(function () {

    //Needs authentication
    Route::post('/logout', [UserController::class, 'logout'])
        ->name('logout')
        ->middleware(['auth:sanctum']);

    //Needs admin rights
    Route::middleware(['auth:sanctum', 'admin'])->group(function () {
        Route::apiResource('books', BookController::class)->parameters([
            'books' => 'id',
        ])->only([
            'update',
            'destroy',
            'store',
        ]);
    });

    Route::post('/login', [UserController::class, 'login'])->name('login');
    
    Route::apiResource('books', BookController::class)->parameters([
        'books' => 'id',
    ])->only([
        'show',
        'index',
    ]);  
});
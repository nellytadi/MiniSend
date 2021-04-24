<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\StatusController;
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

Route::post('/login',[UserController::class,'login']);
Route::post('/logout',[UserController::class,'logout']);


Route::middleware(['json.response','auth:sanctum'])->group(function () {

    Route::post('/email/store', [EmailController::class, 'store']);
    Route::get('/email/id/{id}', [EmailController::class, 'getById']);
    Route::get('/email/recipient/{recipient}', [EmailController::class, 'getByRecipient']);
    Route::get('/email/search/', [EmailController::class,'search']);
    Route::get('/email/statuses/', [StatusController::class,'getStatuses']);

});



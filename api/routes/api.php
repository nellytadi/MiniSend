<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailController;

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


Route::post('/email/store',[EmailController::class,'store']);
Route::get('/email/{id}',[EmailController::class,'getById']);
Route::get('/email/recipient/{recipient}',[EmailController::class,'getByRecipient']);
Route::get('/email/search',[EmailController::class,'search']);



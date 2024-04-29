<?php

use App\Http\Controllers\Api\CompanyApiController;
use App\Http\Controllers\TestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::resource('company', CompanyApiController::class);
Route::get('/test', [TestController::class, 'handleAPI']);

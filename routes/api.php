<?php

use App\Http\Controllers\Api\CompanyApiController;
use App\Http\Controllers\API\DetailJobAPIController;
use App\Http\Controllers\TestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('company/job', [CompanyApiController::class, "getJob"]);
Route::get('company/{id}', [CompanyApiController::class, "show"]);
Route::get('/job/id={id}', [DetailJobAPIController::class, "show"]);
Route::get('/test', [TestController::class, 'handleAPI']);

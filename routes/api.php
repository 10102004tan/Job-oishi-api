<?php

use App\Http\Controllers\Api\BenifitAPIDBController;
use App\Http\Controllers\Api\CompanyApiController;
use App\Http\Controllers\Api\CompanyAPIDBController;
use App\Http\Controllers\Api\JobAPIDBController;
use App\Http\Controllers\TestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::resource('company', CompanyApiController::class);

Route::get('/test', [TestController::class, 'handleAPI']);


Route::get('companies/id={id}', [CompanyAPIDBController::class, 'getDetail']);
Route::get('jobs/id={id}', [JobAPIDBController::class, 'getDetail']);

Route::resource('benifits', BenifitAPIDBController::class);
Route::resource('jobs', JobAPIDBController::class);
Route::resource('companies', CompanyAPIDBController::class);

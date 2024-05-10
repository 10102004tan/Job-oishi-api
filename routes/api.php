<?php

use App\Http\Controllers\Api\BenefitAPIDBController;
use App\Http\Controllers\Api\CompanyApiController;
use App\Http\Controllers\API\DetailJobAPIController;
use App\Http\Controllers\Api\CompanyAPIDBController;
use App\Http\Controllers\Api\JobAPIDBController;
use App\Http\Controllers\Api\JobController;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\TestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::get('company/job', [CompanyApiController::class, "getJob"]);
Route::get('company/{id}', [CompanyApiController::class, "show"]);
Route::get('/job/id={id}', [DetailJobAPIController::class, "show"]);
Route::resource('company', CompanyApiController::class);
Route::get('/test', [TestController::class, 'handleAPI']);
Route::get('companies/id={id}', [CompanyAPIDBController::class, 'getDetail']);
Route::get('jobs/id={id}', [JobAPIDBController::class, 'getDetail']);

Route::resource('benefits', BenefitAPIDBController::class);
Route::resource('jobs', JobAPIDBController::class);
Route::resource('companies', CompanyAPIDBController::class);


Route::get('/company/{id}', [CompanyApiController::class, "show"])->name("detail_company");

Route::get('/test', [TestController::class, 'handleAPI']);
Route::get("/jobs", [JobController::class, 'index']);
Route::get("/user/{id}", [UserApiController::class, "show"])->name("detail_user");
Route::post("/user/{id}", [UserApiController::class, "update"])->name("update_user");
Route::delete("/user/{id}", [UserApiController::class, "destroy"])->name("delete_user");
Route::post("/user", [UserApiController::class, "store"])->name("create_user");
Route::get("/user", [UserApiController::class, "index"]);

<?php

use App\Http\Controllers\Api\CompanyApiController;
use App\Http\Controllers\Api\JobController;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\TestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::get('/company/job', [CompanyApiController::class, "getJob"]);
Route::get('/company/{id}', [CompanyApiController::class, "show"])->name("detail_company");
Route::get('/test', [TestController::class, 'handleAPI']);
Route::get("/jobs", [JobController::class, 'index']);
Route::get("/user/{id}", [UserApiController::class, "show"])->name("detail_user");
Route::post("/user/{id}", [UserApiController::class, "update"])->name("update_user");
Route::delete("/user/{id}", [UserApiController::class, "destroy"])->name("delete_user");
Route::post("/user", [UserApiController::class, "store"])->name("create_user");
Route::get("/user", [UserApiController::class, "index"]);

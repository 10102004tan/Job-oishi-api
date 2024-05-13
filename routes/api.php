<?php

use App\Http\Controllers\Api\CompanyApiController;
use App\Http\Controllers\Api\JobController;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

// Company api routes
Route::get('/company/job', [CompanyApiController::class, "getJob"]);
Route::get('/company/{id}', [CompanyApiController::class, "show"])->name("detail_company");

// Job api routes
Route::get('/test', [TestController::class, 'handleAPI']);
Route::get("/jobs", [JobController::class, 'index']);

// User api routes
Route::get("/user/{id}", [UserApiController::class, "show"])->name("detail_user");
Route::post("/user/{id}", [UserApiController::class, "update"])->name("update_user");
Route::delete("/user/{id}", [UserApiController::class, "destroy"])->name("delete_user");
Route::post("/user", [UserApiController::class, "store"])->name("create_user");
Route::get("/user", [UserApiController::class, "index"]);

// User job criteria api routes
Route::get("/user/{id}/job_criteria", [UserApiController::class, "getJobCriteria"])->name("get_job_criteria");
Route::post("/user/{id}/job_criteria", [UserApiController::class, "updateJobCriteria"])->name("update_job_criteria");

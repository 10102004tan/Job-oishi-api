<?php

use App\Http\Controllers\Api\BenefitAPIDBController;
use App\Http\Controllers\Api\CompanyApiController;
use App\Http\Controllers\API\DetailJobAPIController;
use App\Http\Controllers\Api\CompanyAPIDBController;
use App\Http\Controllers\Api\JobAPIDBController;
use App\Http\Controllers\Api\JobController;
use App\Http\Controllers\Api\JobSearchController;
use App\Http\Controllers\Api\UploadFileController;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\AppliedJobController;
use App\Http\Controllers\JobAppliedController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\TestController;
use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Upload file api
Route::post('/upload', [UploadFileController::class, "store"]);


// Company api routes
Route::get('/company/job', [CompanyApiController::class, "getJob"]);
Route::get('company/{id}', [CompanyAPIDBController::class, 'getDetail']);
Route::resource('companies', CompanyAPIDBController::class);


// Job api routes
Route::get('/job/{id}', [JobAPIDBController::class, 'getDetail']);
Route::resource('benefits', BenefitAPIDBController::class);


Route::post("/jobs", [JobController::class, 'index']);
Route::post("/jobs2", [JobAPIDBController::class, 'index']);

// JOb search
Route::get("/jobs/search/", [JobSearchController::class, 'search']);


// User api routes
Route::post("/user/login", [UserApiController::class, "login"])->name("user_login");
Route::get("/user/{id}", [UserApiController::class, "show"])->name("detail_user");
Route::post("/user/{id}", [UserApiController::class, "update"])->name("update_user");
Route::delete("/user/{id}", [UserApiController::class, "destroy"])->name("delete_user");
Route::post("/user", [UserApiController::class, "store"])->name("create_user");
Route::get("/user", [UserApiController::class, "index"]);

// Applied Job

// Hàm lưu user_id và  job_id nào trong bảng
Route::post('/applied', [AppliedJobController::class, "store"]);

// Truy vấn những job đã applied của user nào đó
Route::post('/applied-job', [AppliedJobController::class, 'index']);


//notification start route resource
Route::resource('notifications', NotificationController::class);
//notification end route resource


// User job criteria api routes
Route::get("/user/{id}/job_criteria", [UserApiController::class, "getJobCriteria"])->name("get_job_criteria");
Route::post("/user/{id}/job_criteria", [UserApiController::class, "updateJobCriteria"])->name("update_job_criteria");

//api cho users_device với phương thức post
Route::post('fcm', [UserApiController::class, "saveFcmToken"])->name('user.fcm');

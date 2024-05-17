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
use App\Http\Controllers\JobAppliedController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\TestController;
use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('company/job', [CompanyApiController::class, "getJob"]);
Route::get('company/{id}', [CompanyApiController::class, "show"]);
Route::get('/job/id={id}', [DetailJobAPIController::class, "show"]);
Route::post('/upload', [UploadFileController::class, "store"]);


// Company api routes
Route::get('/company/job', [CompanyApiController::class, "getJob"]);
Route::get('/company/{id}', [CompanyApiController::class, "show"])->name("detail_company");
Route::resource('company', CompanyApiController::class);
Route::get('companies/id={id}', [CompanyAPIDBController::class, 'getDetail']);
Route::resource('companies', CompanyAPIDBController::class);


// Job api routes
Route::get('/job/id={id}', [DetailJobAPIController::class, "show"]);
Route::get('jobs/id={id}', [JobAPIDBController::class, 'getDetail']);
Route::resource('benefits', BenefitAPIDBController::class);
Route::resource('jobs2', JobAPIDBController::class);


Route::get('/company/job', [CompanyApiController::class, "getJob"]);
Route::get('/company/{id}', [CompanyApiController::class, "show"])->name("detail_company");

Route::get('/test', [TestController::class, 'handleAPI']);

// JOb search
Route::get("/sjobs/search/", [JobSearchController::class, 'search']);
Route::get("/sjobs", [JobSearchController::class, 'index']);


//bookmark start
Route::prefix('jobs')->group(function () {
    Route::prefix('bookmark')->group(function () {
        Route::post("/", [JobController::class, 'bookmark'])->name('jobs.bookmark');
        Route::post("/all", [JobController::class, 'getAllJobsBookmark']);
        Route::delete("/destroy", [JobController::class, 'destroyJobOnBookmark']);
    });
});
//bookmark end

// User api routes
Route::post("/user/login", [UserApiController::class, "login"])->name("user_login");
Route::get("/user/{id}", [UserApiController::class, "show"])->name("detail_user");
Route::post("/user/{id}", [UserApiController::class, "update"])->name("update_user");
Route::delete("/user/{id}", [UserApiController::class, "destroy"])->name("delete_user");
Route::post("/user", [UserApiController::class, "store"])->name("create_user");
Route::get("/user", [UserApiController::class, "index"]);

// Applied Job
Route::post('/applied', [JobAppliedController::class, "store"]);


//notification start route resource
Route::resource('notifications', NotificationController::class);
//notification end route resource


// User job criteria api routes
Route::get("/user/{id}/job_criteria", [UserApiController::class, "getJobCriteria"])->name("get_job_criteria");
Route::post("/user/{id}/job_criteria", [UserApiController::class, "updateJobCriteria"])->name("update_job_criteria");
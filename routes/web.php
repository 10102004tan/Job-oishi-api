<?php

use App\Http\Controllers\Api\JobController as ApiJobController;
use App\Http\Controllers\BenefitController;
use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\TestController;

Route::get('/',[ HomeController::class,'index'])->name('home');
Route::resource('jobs', JobController::class);
Route::resource('companies', CompanyController::class);
Route::resource('benefits', BenefitController::class);


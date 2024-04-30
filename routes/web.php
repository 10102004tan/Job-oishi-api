<?php

use App\Http\Controllers\BenifitController;
use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;

Route::get('/',[ HomeController::class,'index'])->name('home');
Route::resource('jobs', JobController::class);
Route::resource('companies', CompanyController::class);
Route::resource('benifits', BenifitController::class);

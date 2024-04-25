<?php
use App\Http\Controllers\Admin\JobTypeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

use App\Http\Controllers\Admin\JobCategoryContoller;
use App\Http\Controllers\Admin\ExperienceController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/dashboard',[AdminController::class,'dashboard'])->name('dashboard');
Route::resource('jobCategory',JobCategoryContoller::class);
Route::put('jobCategory/{jobCategory}/updatejobCategoryStatus',[JobCategoryContoller::class,'updateStatus'])->name('jobCategory.updatejobCategoryStatus');

Route::resource('jobType',JobTypeController::class);
Route::put('jobType/{jobType}/updatejobTypeStatus',[JobTypeController::class,'updateStatus'])->name('jobCategory.updatejobTypeStatus');

Route::resource('experience',ExperienceController::class);
Route::put('experience/{experience}/updateexperienceStatus',[ExperienceController::class,'updateStatus'])->name('experience.updateexperienceStatus');

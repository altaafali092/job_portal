<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\jobsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',[FrontendController::class,'index'])->name('index');

Route::get('/login',[AuthController::class,'login'])->name('login');
Route::get('/register',[AuthController::class,'register'])->name('register');
Route::post('/registration',[AuthController::class,'registration'])->name('registration');
Route::post('/loginpost',[AuthController::class,'loginpost'])->name('loginpost');
Route::get('/logout',[AuthController::class,'logout'])->name('logout');


Route::get('/profile',[FrontendController::class,'profile'])->name('profile');
Route::get('/profilepic',[FrontendController::class,'profilepic'])->name('profilepic');
// Route::get('/job',[FrontendController::class,'job'])->name('job');
Route::resource('/job',jobsController::class);
Route::get('/myJobs',[FrontendController::class,'myJobs'])->name('myJobs');
Route::get('/findJob',[FrontendController::class,'findJob'])->name('findJob');
// routes/web.php

Route::get('/search/findJob', [FrontendController::class, 'findJob'])->name('search.findJob');

Route::get('job/{job}/job-apply', [FrontendController::class, 'jobapply'])->name('jobapply');

Route::get('/appliedjob',[FrontendController::class,'appliedjob'])->name('appliedjob');
Route::delete('/appliedjob/{id}', [FrontendController::class, 'deleteAppliedJob'])->name('appliedjob.delete');

Route::get('job/{job}/save-jobs',[FrontendController::class,'savejob'])->name('savejob');
Route::get('/save-jobs',[FrontendController::class,'saveJoblist'])->name('saveJoblist');
Route::delete('/savedjob/{id}', [FrontendController::class, 'deleteSavedJob'])->name('savedjob.delete');








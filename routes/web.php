<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\MyJobApplicationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\UserController;
use App\Models\JobApplication;
use App\Models\User;

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
Hello

Route::get('', fn()=>to_route('jobs.index'));
// dùng Route::resource('jobs', JobController::class ); tạo ra các route chuẩn như sau:
// GET /jobs để hiển thị danh sách công việc
// GET /jobs/create để hiển thị form tạo mới công việc
// POST /jobs để lưu công việc mới từ form
// GET /jobs/{id} để hiển thị thông tin của công việc có id là {id}
// GET /jobs/{id}/edit để hiển thị form cập nhật thông tin công việc
// PUT/PATCH /jobs/{id} để cập nhật thông tin công việc từ form
// DELETE /jobs/{id} để xóa một công việc
Route::resource('jobs', JobController::class )
    ->only(['index', 'show']);

////tạo đường dẫn là /login sau đó khi truy cập đường dẫn thì callback function: fn()=>to_route('auth.create')
// sẽ chuyển hướng người dùng đến route auth.create (auth/create)
Route::get('login',fn()=>to_route('auth.create'))->name('login');

Route::resource('auth', AuthController::class)
    ->only(['create', 'store']);

Route::delete('logout',fn()=>to_route('auth.destroy'))->name('logout');
// Cach 1:  Route::delete('auth', 'AuthController@destroy')->name('auth.destroy');
//Cach 2:
Route::delete('auth', [AuthController::class,'destroy'])->name('auth.destroy');

Route::get('register',[UserController::class, 'register'])->name('user.register');

Route::post('register',[UserController::class, 'handle']);

Route::middleware('auth')->group(function () {
    Route::resource('job.application', JobApplicationController::class)
        ->only(['create', 'store']);

    Route::resource('my-job-applications', MyJobApplicationController::class)
        ->only(['index', 'destroy']);
});


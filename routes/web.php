<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\StudentBasicFiremanshipController;
use App\Http\Controllers\ReportBasicFiremanship;
use App\Http\Controllers\ReportinServiceController;
use App\Http\Controllers\StudentinServiceController;
use App\Http\Controllers\MultiStepFormController;


Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
// Route::get('/', [LoginController::class, 'showLoginForm'])->name('welcome');
 Route::get('/', [HomeController::class, 'index'])->name('welcome');
Route::get('/admin/dashboard', [HomeController::class, 'index'])->name('dashboard');
// Route::get('/admin/dashboardHome', [HomeController::class, 'dashboardHome'])->name('dashboardHome');
Route::get('/admin/recommendation', [RecommendationController::class, 'index'])->name('recommendation');
Route::get('/admin/reportbasicfiremanship', [ReportBasicFiremanship::class, 'index'])->name('reportbasicfiremanship');
Route::get('/admin/reportinservice', [ReportinServiceController::class, 'index'])->name('reportinservice');
Route::get('/admin/paradereportbasicfiremanship', [ReportBasicFiremanship::class, 'create'])->name('paradereportbasicfiremanship');
Route::get('/admin/paradereportinservice', [ReportinServiceController::class, 'create'])->name('paradereportinservice');
Route::get('/admin/studentbasicfiremanship', [StudentBasicFiremanshipController::class, 'index'])->name('studentbasicfiremanship');
Route::get('/admin/studentinservice', [StudentinServiceController::class, 'index'])->name('studentinservice');
Route::get('/admin/usermanagement', [UserManagementController::class, 'index'])->name('usermanager');
Route::get('admin/profile', [UserManagementController::class, 'profile'])->name('profile');
// Route::get('/admin/modelform', [HomeController::class, 'modelform'])->name('modelform');



require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;


Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
// Route::get('/', [LoginController::class, 'showLoginForm'])->name('welcome');
 Route::get('/', [HomeController::class, 'index'])->name('welcome');
Route::get('/admin/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
Route::get('/admin/dashboardHome', [HomeController::class, 'dashboardHome'])->name('dashboardHome');
Route::get('/admin/recommendation', [HomeController::class, 'recommendation'])->name('recommendation');
Route::get('/admin/reportbasicfiremanship', [HomeController::class, 'reportbasicfiremanship'])->name('reportbasicfiremanship');
Route::get('/admin/reportinservice', [HomeController::class, 'reportinservice'])->name('reportinservice');
Route::get('/admin/studentbasicfiremanship', [HomeController::class, 'studentbasicfiremanship'])->name('studentbasicfiremanship');
Route::get('/admin/studentinservice', [HomeController::class, 'studentinservice'])->name('studentinservice');
Route::get('/admin/usermanagement', [HomeController::class, 'usermanagement'])->name('usermanagement');
Route::get('/admin/modelform', [HomeController::class, 'modelform'])->name('modelform');

Route::get('/profile', [UserController::class, 'show'])->name('profile');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');



require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

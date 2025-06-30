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
use App\Http\Middleware\RoleMiddleware;


 Route::get('/', [HomeController::class, 'showWelcomePage'])->name('welcome');


Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/admin/reportbasicfiremanship', [ReportBasicFiremanship::class, 'index'])->name('reportbasicfiremanship');
    Route::get('/admin/reportinservice', [ReportinServiceController::class, 'index'])->name('reportinservice');
    Route::get('/admin/studentbasicfiremanship', [StudentBasicFiremanshipController::class, 'index'])->name('studentbasicfiremanship');
    Route::put('/admin/studentbasicfiremanship/{id}', [StudentBasicFiremanshipController::class, 'update'])->name('students.update');
    Route::get('/admin/studentinservice', [StudentinServiceController::class, 'index'])->name('studentinservice');
    Route::get('admin/profile', [UserManagementController::class, 'profile'])->name('profile');
});


Route::middleware(['auth'])->group(function () {

    // Only admin can access these
    Route::middleware([RoleMiddleware::class . ':admin,co,ci'])->group(function () {
        Route::delete('/admin/studentbasicfiremanship/{id}', [StudentBasicFiremanshipController::class, 'destroy'])->name('students.destroy');
        Route::post('/admin/recommendation', [RecommendationController::class, 'store'])->name('recommendation.store');
        Route::get('/admin/recommendation', [RecommendationController::class, 'index'])->name('recommendation');
        Route::get('/admin/usermanagement', [UserManagementController::class, 'index'])->name('usermanager');
    });
});

Route::middleware(['auth'])->group(function () {

    // Only sergeant major and hc can access these
    Route::middleware([RoleMiddleware::class . ':hc,sm'])->group(function () {
        Route::get('/admin/paradereportbasicfiremanship', [ReportBasicFiremanship::class, 'create'])->name('paradereportbasicfiremanship');
        Route::get('/admin/paradereportinservice', [ReportinServiceController::class, 'create'])->name('paradereportinservice');
    });
});



require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

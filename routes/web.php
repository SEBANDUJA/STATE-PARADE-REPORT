<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\HomeController;

// Route::get('/', function () {
//     return Inertia::render('home');
// })->name('home');

 Route::get('/', [HomeController::class, 'index'])->name('welcome');
Route::get('/admin/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
Route::get('/admin/dashboardHome', [HomeController::class, 'dashboardHome'])->name('dashboardHome');
Route::get('/admin/recommendation', [HomeController::class, 'recommendation'])->name('recommendation');
Route::get('/admin/reportFiremanship', [HomeController::class, 'reportFiremanship'])->name('reportFiremanship');


require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

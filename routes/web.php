<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepotController;

// Authentication routes
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin and User routes
Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
Route::get('/user', [UserController::class, 'index'])->name('user.dashboard');

// Routes for user dashboard sections
Route::get('/user/depot', [UserController::class, 'depot'])->name('user.depot');
Route::get('/user/suivi', [UserController::class, 'suivi'])->name('user.suivi');

// Depot management routes
Route::post('/depot/store', [DepotController::class, 'store'])->name('depot.store');
Route::get('/suivi', [DepotController::class, 'index'])->name('depot.suivi');
Route::delete('/depot/{id}', [DepotController::class, 'destroy'])->name('depot.destroy');
Route::get('/depot/{id}', [DepotController::class, 'show'])->name('depot.show');
Route::post('/depot/{id}/approve', [DepotController::class, 'approve'])->name('depot.approve');
Route::post('/depot/{id}/decline', [DepotController::class, 'decline'])->name('depot.decline');

// Admin management of contribuables
Route::post('/admin/contribuables/store', [UserController::class, 'storeContribuable'])->name('admin.contribuables.store');
Route::get('/admin/contribuable/{id}', [AdminController::class, 'showContribuableDepots'])->name('admin.contribuable.depots');

<?php

use App\Http\Controllers\BloodTypeController;
use App\Http\Controllers\AllergyController;
use App\Http\Controllers\CivilStatusController;
use App\Http\Controllers\DisabilityController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\BarangayController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'index'])->name('login.index');
Route::post('/login/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])
    ->group(function () {

        Route::middleware('role:superadmin')
            ->prefix('sa')
            ->name('superadmin.')
            ->group(function () {
                Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
                Route::resource('blood', BloodTypeController::class)->middleware('merge_cms:blood_types,blood');
                Route::resource('allergy', AllergyController::class)->middleware('merge_cms:allergies,allergy');
                Route::resource('civil', CivilStatusController::class)->middleware('merge_cms:civil_statuses,civil');
                Route::resource('disability', DisabilityController::class)->middleware('merge_cms:disabilities,disability');
                Route::resource('district', DistrictController::class)->middleware('merge_cms:districts,district');
                Route::resource('barangay', BarangayController::class)->middleware('merge_cms:barangays,barangay');
            });

        Route::middleware('role:admin')
            ->prefix('ad')
            ->name('admin.')
            ->group(function () {
                Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
                Route::resource('blood', BloodTypeController::class)->middleware('merge_cms:blood_types');
                Route::resource('allergy', AllergyController::class)->middleware('merge_cms:allergies,allergy');
                Route::resource('civil', CivilStatusController::class)->middleware('merge_cms:civil_statuses,civil');
                Route::resource('disability', DisabilityController::class)->middleware('merge_cms:disabilities,disability');
                Route::resource('district', DistrictController::class)->middleware('merge_cms:districts,district');
                Route::resource('barangay', BarangayController::class)->middleware('merge_cms:barangays,barangay');
            });

        Route::middleware('role:user')
            ->prefix('us')
            ->name('user.')
            ->group(function () {
                Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
            });
    });
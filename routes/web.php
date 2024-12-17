<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PackageFeatureController;
use App\Http\Controllers\PackageInclusionExclusionController;
use App\Http\Controllers\FaqController;


Route::get('/', function () {
    return view('auth.login');
});




Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::resource('packages', PackageController::class);
Route::resource('package-features', PackageFeatureController::class);
Route::resource('packageInclusionExclusions', PackageInclusionExclusionController::class);
Route::resource('faqs', FaqController::class);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

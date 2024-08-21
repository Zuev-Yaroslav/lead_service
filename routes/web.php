<?php

use App\Http\Controllers\LeadController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

//Route::get('/', function () {
//    return Inertia::render('Welcome', [
//        'canLogin' => Route::has('login'),
//        'canRegister' => Route::has('register'),
//        'laravelVersion' => Application::VERSION,
//        'phpVersion' => PHP_VERSION,
//    ]);
//});

Route::get('/', MainController::class)->name('main.index');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
});
Route::group(['prefix' => 'leads', 'as' => 'leads.'], function () {
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/', [LeadController::class, 'index'])->name('index');
        Route::get('/{lead}', [LeadController::class, 'edit'])->name('edit');
        Route::patch('/{lead}/update-status', [LeadController::class, 'updateStatus'])->name('update_status');
        Route::patch('/{lead}', [LeadController::class, 'update'])->name('update');
        Route::delete('/{lead}', [LeadController::class, 'destroy'])->name('destroy');
    });
    Route::post('/', [LeadController::class, 'store'])->name('store');
});


require __DIR__.'/auth.php';

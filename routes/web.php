<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Redirect root URL to /login
Route::get('/', function () {
    return redirect('/login');
});

// Dashboard route
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Display the profile edit form
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    // Update the user's profile information (supports both PUT and PATCH methods)
    Route::match(['put', 'patch'], '/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // Delete the user's account
    Route::delete('/profile/delete', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

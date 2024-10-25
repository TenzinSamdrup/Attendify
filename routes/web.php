<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
})->name('login');

// Admin and Employee routes (protected)
Route::middleware('auth')->group(function () {
    Route::get('/adminDashboard', function () {
        return view('admin.adminDashboard');
    })->name('admin.dashboard'); // Route name defined here

    Route::get('/employeeDashboard', function () {
        return view('employee.empDashboard');
    })->name('employee.dashboard'); // Route name defined here

    // Logout route
    Route::post('/logout', function () {
        Auth::logout(); // Log the user out
        return redirect('/'); // Redirect to the login page
    })->name('logout');
});
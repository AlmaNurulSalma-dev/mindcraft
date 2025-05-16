<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Root route
Route::get('/', function () {
    if (Auth::check()) {
        $role = Auth::user()->role;
        return redirect("/{$role}");
    }
    
    return redirect('/app/login');
});

// Logout
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// Login fallback
Route::get('/login', function () {
    return redirect('/app/login');
})->name('login');
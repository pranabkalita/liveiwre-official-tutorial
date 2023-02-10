<?php

use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Dashboard;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::redirect('/', 'dashboard');

    Route::get('/dashboard', Dashboard::class)->name('dashboard');
});


Route::middleware(['guest'])->group(function () {
    Route::get('/register', Register::class)->name('auth.register');
    Route::get('/login', Login::class)->name('auth.login');
});

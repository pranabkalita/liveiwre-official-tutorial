<?php

use App\Http\Livewire\Auth\Register;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['success!'];
});

Route::get('/register', Register::class);

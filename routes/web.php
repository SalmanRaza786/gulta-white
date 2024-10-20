<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\CustomerController;






    Route::get('/', [HomeController::class, 'index'])->name('user.index');
    Route::any('/code-verify', [HomeController::class, 'codeVerify'])->name('code.verify');




    Route::get('/logout', [HomeController::class, 'customLogout'])->name('user.logout');

    Route::group([],base_path("routes/admin.php"));



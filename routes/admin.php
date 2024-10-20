<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\ProductController;



    Auth::routes(['verify' => true]);


    Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {



    Route::get('dashboard', [AdminHomeController::class, 'index'])->name('dashboard');
        Route::get('/product', [ProductController::class, 'index'])->name('products.index');
        Route::post('/product-save', [ProductController::class, 'saveProduct'])->name('product.add');
        Route::get('/product-list', [ProductController::class, 'productList']);
        Route::get('/edit-product', [ProductController::class, 'editProduct'])->name('product.edit');
        Route::any('/delete-product', [ProductController::class, 'deleteProduct']);

        Route::get('/p-codes', [ProductController::class, 'pCodes'])->name('products.codes');
        Route::post('/p-codes-store', [ProductController::class, 'pCodesCreate'])->name('product.code.create');
        Route::get('/p-codes-list', [ProductController::class, 'pCodesList']);

        Route::get('/attempt-codes', [ProductController::class, 'attemptCodes'])->name('attempt.codes');
        Route::get('/attempt-code-list', [ProductController::class, 'attemptCodeList']);
        Route::any('/code-print', [ProductController::class, 'codePrint'])->name('codes.print');
        Route::any('/print-code-batch/{batch}', [ProductController::class, 'printCodeBatch'])->name('codes.print.batch');

        Route::get('/messages',[ProductController::class,'messageIndex'])->name('message.index');
        Route::get('/message-list',[ProductController::class,'messageList']);
        Route::get('/edit-text-message',[ProductController::class,'editTextMessage']);
        Route::any('/update-message',[ProductController::class,'updateTextMessage'])->name('text.message.update');





    });



    Route::get('/admin-logout', [HomeController::class, 'customLogout'])->name('admin.logout');
    Route::get('/admin',[LoginController::class,'showAdminLoginForm'])->name('admin.login.view');
    Route::post('/admin',[LoginController::class,'adminLogin'])->name('admin.login');







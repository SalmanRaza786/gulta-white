<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\TestimonialController;

use App\Http\Controllers\CustomerController;


    Route::any('/', [HomeController::class, 'index'])->name('user.index');
    Route::any('/code-verify', [HomeController::class, 'codeVerify'])->name('code.verify');

    Route::get('/gallery', [HomeController::class, 'gallery'])->name('user.gallery');
    Route::get('/blogs', [HomeController::class, 'blogs'])->name('user.blogs');
    Route::get('/contact-us', [HomeController::class, 'contactUs'])->name('user.contact.us');
    Route::get('/about-us', [HomeController::class, 'aboutUs'])->name('user.about.us');
    Route::get('/faqs', [HomeController::class, 'faqs'])->name('user.faq');
    Route::post('/review-store', [TestimonialController::class, 'updateOrCreateRecord'])->name('user.review.store');




    Route::get('/logout', [HomeController::class, 'customLogout'])->name('user.logout');

    Route::group([],base_path("routes/admin.php"));



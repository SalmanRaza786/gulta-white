<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\FAQsController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PagesController;




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


        //FAQS
        Route::get('/faqs', [FAQsController::class, 'index'])->name('faqs.index');
        Route::get('/faqs-list', [FAQsController::class, 'faqsList'])->name('faqs.list');
        Route::any('/delete-faqs', [FAQsController::class, 'deleteFaqs'])->name('faqs.delete');
        Route::post('store-faqs', [FAQsController::class, 'updateOrCreateRecord'])->name('faqs.store');


        //roles
        Route::get('roles', [RoleController::class, 'index'])->name('roles.index');
        Route::any('get-roles', [RoleController::class, 'getRoles'])->name('roles.get');
        Route::get('edit-role', [RoleController::class, 'editRole'])->name('roles.edit');
        Route::post('add-role', [RoleController::class, 'updateOrCreateRecord'])->name('roles.add');
        Route::any('/delete-role', [RoleController::class, 'deleteRole'])->name('roles.delete');

        //users
        Route::any('/user', [UserController::class, 'index'])->name('user.index')->middleware(['can:admin-user-view']);
        Route::any('/user-list', [UserController::class, 'userList'])->name('user.list')->middleware(['can:admin-user-view']);
        Route::any('/save-update-user', [UserController::class, 'userCreateOrUpdate'])->name('user.store')->middleware(['can:admin-user-create']);
        Route::any('/edit-user/{id}', [UserController::class, 'edit'])->name('user.edit')->middleware(['can:admin-user-edit']);
        Route::any('/delete-user/{id}', [UserController::class, 'destroy'])->name('user.delete')->middleware(['can:admin-user-delete']);

        //permissions
        Route::any('/get-role-has-permissions/{role_id}', [PermissionController::class, 'getRoleHasPermissions'])->name('roles.permissions');
        Route::post('assign-permissions', [PermissionController::class, 'assignPermissions'])->name('permissions.assign');

        Route::get('/pages', [PagesController::class, 'index'])->name('pages.index');
        Route::get('/create-pages', [PagesController::class, 'create'])->name('pages.create');



    });



    Route::get('/admin-logout', [HomeController::class, 'customLogout'])->name('admin.logout');
    Route::get('/admin',[LoginController::class,'showAdminLoginForm'])->name('admin.login.view');
    Route::post('/admin',[LoginController::class,'adminLogin'])->name('admin.login');







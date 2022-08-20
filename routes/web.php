<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookPurchaseController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Sevice\SelectController;
use App\Http\Controllers\Admin\Membership\RoleController;
use App\Http\Controllers\Admin\Membership\UserController;
use App\Http\Controllers\Admin\Membership\ProfileController;
use App\Http\Controllers\Admin\Membership\PermissionController;
use App\Http\Controllers\Admin\Membership\OrganizationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return to_route('admin.dashboard');
});

Route::get('/opt',function (){
   \Illuminate\Support\Facades\Artisan::call('optimize:clear');

});
Route::prefix('/admin')->middleware(['auth'])->group(function() {

    //select
    Route::prefix('/select')->group(function(){
        Route::post('/select-user',[SelectController::class , 'selectUser'])->name('admin.select.selectUser');
        Route::post('/select-organization',[SelectController::class , 'selectOrganization'])->name('admin.select.selectOrganization');
    });

    //dashboard
    Route::get('/dashboard',[DashboardController::class, 'index'])->name('admin.dashboard');

    //membership
    Route::prefix('/membership')->group(function() {

        //profile
        Route::prefix('profile')->group(function(){
            Route::get('/',[ProfileController::class , 'profile'])->name('admin.membership.profile');
            Route::put('/change-avatar',[ProfileController:: class , 'changeAvatar'])->name('admin.membership.profile.changeAvatar');
            Route::put('/change-profile-information',[ProfileController:: class , 'changeProfileInformation'])->name('admin.membership.profile.changeProfileInformation');
        });

        //user
        Route::prefix('/user')->group(function() {
            Route::get('/',[UserController::class , 'index'])->name('admin.membership.user.index');
            Route::get('/create',[UserController::class , 'create'])->name('admin.membership.user.create');
            Route::post('/store',[UserController::class , 'store'])->name('admin.membership.user.store');
            Route::get('/show/{user}',[UserController::class , 'show'])->name('admin.membership.user.show');
            Route::get('/edit/{user}',[UserController::class , 'edit'])->name('admin.membership.user.edit');
            Route::put('/update/{user}',[UserController::class , 'update'])->name('admin.membership.user.update');
            Route::post('/destroy',[UserController::class , 'destroy'])->name('admin.membership.user.destroy');
            Route::post('/status',[UserController::class , 'status'])->name('admin.membership.user.status');
            //import
            Route::get('/import',[UserController::class , 'importIndex'])->name('admin.membership.user.import.index');
            Route::get('/sample',[UserController::class , 'importSample'])->name('admin.membership.user.import.sample');
            Route::post('/upload',[UserController::class , 'importUpload'])->name('admin.membership.user.import.upload');
            //print
            Route::get('/logprint',[UserController::class,'logprint'])->name('admin.membership.user.logprint');
            Route::post('/printUser',[UserController::class,'printUser'])->name('admin.membership.user.printUser');
        });

        //organization
        Route::prefix('/organization')->group(function() {
            Route::get('/',[OrganizationController::class, 'index'])->name('admin.membership.organization.index');
            Route::get('/create',[OrganizationController::class, 'create'])->name('admin.membership.organization.create');
            Route::post('/store',[OrganizationController::class, 'store'])->name('admin.membership.organization.store');
            Route::get('/show/{organization}',[OrganizationController::class, 'show'])->name('admin.membership.organization.show');
            Route::get('/edit/{organization}',[OrganizationController::class, 'edit'])->name('admin.membership.organization.edit');
            Route::put('/update/{organization}',[OrganizationController::class, 'update'])->name('admin.membership.organization.update');
            Route::post('/destroy',[OrganizationController::class , 'destroy'])->name('admin.membership.organization.destroy');
            Route::post('/status',[OrganizationController::class , 'status'])->name('admin.membership.organization.status');
        });

        //role
        Route::prefix('/role')->group(function() {
            Route::get('/',[RoleController::class,'index'])->name('admin.membership.role.index');
            Route::get('/create',[RoleController::class,'create'])->name('admin.membership.role.create');
            Route::post('/store',[RoleController::class,'store'])->name('admin.membership.role.store');
            Route::get('/edit/{role}',[RoleController::class,'edit'])->name('admin.membership.role.edit');
            Route::put('/update/{role}',[RoleController::class,'update'])->name('admin.membership.role.update');
            Route::post('/destroy',[RoleController::class,'destroy'])->name('admin.membership.role.destroy');
        });

        //permission
        Route::prefix('/permission')->group(function() {
            Route::get('/',[PermissionController::class,'index'])->name('admin.membership.permission.index');
            Route::get('/create',[PermissionController::class,'create'])->name('admin.membership.permission.create');
            Route::post('/store',[PermissionController::class,'store'])->name('admin.membership.permission.store');
            Route::get('/edit/{permission}',[PermissionController::class,'edit'])->name('admin.membership.permission.edit');
            Route::put('/update/{permission}',[PermissionController::class,'update'])->name('admin.membership.permission.update');
            Route::post('/destroy',[PermissionController::class,'destroy'])->name('admin.membership.permission.destroy');
        });

        //books
        Route::get('/books',[BookController::class,'index'])->name('admin.book.index');
        Route::get('/books/{book}/show',[BookController::class,'show'])->name('admin.book.show');
        Route::get('/books/library',[BookController::class,'library'])->name('admin.book.library');
        Route::get('/books/{book}/purchase',[BookPurchaseController::class,'purchase'])->name('admin.book.purchase');
        Route::get('/books/{book}/purchase/result',[BookPurchaseController::class,'result'])->name('admin.book.purchase.result');
        Route::get('/transactions',[BookPurchaseController::class,'transactionShow'])->name('admin.transactionShow');
        //payment-setting
        Route::prefix('/payment')->group(function() {
            Route::get('/setting',[PaymentController::class,'index'])->name('admin.payment.setting.index');
            Route::get('/setting/edit/{payment}',[PaymentController::class,'edit'])->name('admin.payment.setting.edit');
            Route::get('/setting/show/{payment}',[PaymentController::class,'show'])->name('admin.payment.setting.show');
    });
    });

});

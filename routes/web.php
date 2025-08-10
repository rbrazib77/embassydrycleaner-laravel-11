<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\BannerSectionController;

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


 Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');

 Route::middleware('auth')->group(function () {
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'ProfileStore'])->name('profile.store');
    Route::post('/admin/password/update', [AdminController::class, 'AdminPasswordUpdate'])->name('admin.password.update');
    Route::get('/user/list', [AdminController::class, 'UserList'])->name('admin.user.list');
    Route::get('/new/user', [AdminController::class, 'NewUser'])->name('new.user');
    Route::post('/new/user/create', [AdminController::class, 'NewUserCreate'])->name('new.user.create');
    Route::get('/users/destroy/{id}', [AdminController::class, 'destroy'])->name('user.destroy');
});

Route::prefix('admin/banner')->middleware(['auth'])->group(function () {
    Route::get('index', [BannerSectionController::class, 'BannerIndex'])->name('admin.banner.index');
    Route::get('create', [BannerSectionController::class, 'BannerCreate'])->name('admin.banner.create');
    Route::post('store', [BannerSectionController::class, 'BannerStore'])->name('admin.banner.store');
    Route::post('update/{id}', [BannerSectionController::class, 'BannerUpdate'])->name('admin.banner.update');
    Route::get('destroy/{id}', [BannerSectionController::class, 'BannerDelete'])->name('admin.banner.destroy');
    
    
});
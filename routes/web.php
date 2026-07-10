<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ContactSubmissionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EquipmentController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public site
|--------------------------------------------------------------------------
*/
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/menia', [PageController::class, 'menia'])->name('menia');
Route::get('/oprema', [PageController::class, 'oprema'])->name('oprema');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/sitemap.xml', SitemapController::class)->name('sitemap');

/*
|--------------------------------------------------------------------------
| Admin panel
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    // Guest (login)
    Route::middleware('guest')->group(function () {
        Route::get('login', [AuthController::class, 'show'])->name('login');
        Route::post('login', [AuthController::class, 'login'])->name('login.attempt');
    });

    // Authenticated
    Route::middleware('auth')->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');

        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('settings', [SettingsController::class, 'edit'])->name('settings.edit');
        Route::put('settings', [SettingsController::class, 'update'])->name('settings.update');

        Route::get('pages', [AdminPageController::class, 'index'])->name('pages.index');
        Route::get('pages/{page}', [AdminPageController::class, 'edit'])->name('pages.edit');
        Route::put('pages/{page}', [AdminPageController::class, 'update'])->name('pages.update');

        Route::post('menus/reorder', [MenuController::class, 'reorder'])->name('menus.reorder');
        Route::resource('menus', MenuController::class)->except(['show']);

        Route::post('equipment/reorder', [EquipmentController::class, 'reorder'])->name('equipment.reorder');
        Route::resource('equipment', EquipmentController::class)->only(['index', 'store', 'update', 'destroy']);

        Route::post('gallery/reorder', [GalleryController::class, 'reorder'])->name('gallery.reorder');
        Route::get('gallery', [GalleryController::class, 'index'])->name('gallery.index');
        Route::post('gallery', [GalleryController::class, 'store'])->name('gallery.store');
        Route::put('gallery/{image}', [GalleryController::class, 'update'])->name('gallery.update');
        Route::delete('gallery/{image}', [GalleryController::class, 'destroy'])->name('gallery.destroy');

        Route::get('contacts', [ContactSubmissionController::class, 'index'])->name('contacts.index');
        Route::patch('contacts/{contact}', [ContactSubmissionController::class, 'update'])->name('contacts.update');
        Route::delete('contacts/{contact}', [ContactSubmissionController::class, 'destroy'])->name('contacts.destroy');

        Route::post('media', [MediaController::class, 'store'])->name('media.store');
    });
});
